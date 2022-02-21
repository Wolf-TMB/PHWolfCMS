<?php

namespace PHWolfCMS\Kernel\Modules\Render;

use PHWolfCMS\Kernel\Modules\Config\Config;
use PHWolfCMS\Exceptions\ConfigKeyNotFoundException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use PHWolfCMS\Exceptions\RenderMaxIterationLimitException;
use PHWolfCMS\Exceptions\RenderFileBlockNotFoundException;
use PHWolfCMS\Exceptions\RenderFileLayoutNotFoundException;
use PHWolfCMS\Exceptions\RenderDirectoriesNotFoundException;
use PHWolfCMS\Exceptions\RenderFileTemplateNotFoundException;
use function PHWolfCMS\Kernel\str_starts_with;

class Render {
	private Config $config;

	/**
	 * @throws ConfigKeyNotFoundException
	 * @throws RenderDirectoriesNotFoundException
	 */
	public function __construct() {
        global $app;
		$this->config = new Config('module', 'render');
        if (
            !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR'))
            || !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR') . '/' . $this->config->get('RENDER_EMAIL_TEMPLATES_DIR'))
            || !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR') . '/' . $this->config->get('RENDER_DEFAULT_DIR'))
            || !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR') . '/' . $this->config->get('RENDER_DEFAULT_DIR') . '/' . $this->config->get('RENDER_BLOCKS_DIR'))
            || !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR') . '/' . $this->config->get('RENDER_DEFAULT_DIR') . '/' . $this->config->get('RENDER_LAYOUTS_DIR'))
            || !is_dir($app->rootDir . '/' . $this->config->get('RENDER_DIR') . '/' . $this->config->get('RENDER_DEFAULT_DIR') . '/' . $this->config->get('RENDER_TEMPLATES_DIR'))
        ) {
            throw new RenderDirectoriesNotFoundException();
        }
    }

	/**
	 * @throws RenderFileLayoutNotFoundException
	 * @throws RenderMaxIterationLimitException
	 * @throws RenderFileTemplateNotFoundException
	 * @throws ConfigKeyNotFoundException
	 * @throws RenderFileBlockNotFoundException
	 * @throws HttpRouteNotFoundException
	 */
	public function renderPage(string $template, string $layout, array $args = [], string|null $otherPath = null, bool $notfound = false) {
        global $app;
        extract($args);
        $layoutPath = $app->rootDir . $this->config->get('RENDER_DIR') . '/' . (($otherPath) ?? $this->config->get('RENDER_DEFAULT_DIR')) . '/' . $this->config->get('RENDER_LAYOUTS_DIR') . '/' . $layout . '.layout.php';
        if (!file_exists($layoutPath)) throw new RenderFileLayoutNotFoundException();
        require $layoutPath;
        $layout = ob_get_clean();
        $layout = $this->loadTemplates($template, $layout, $args, 0, $notfound, $otherPath);
        print($layout);
    }

	/**
	 * @throws RenderMaxIterationLimitException
	 * @throws HttpRouteNotFoundException
	 * @throws RenderFileTemplateNotFoundException
	 * @throws ConfigKeyNotFoundException
	 * @throws RenderFileBlockNotFoundException
	 */
	private function loadTemplates(string $templateName, string $layout, array $args, int $iteration, bool $notfound, string|null $otherPath) :string {
        global $app;
        $iteration++;
        if ($iteration > $this->config->get('RENDER_MAX_ITERATION')) throw new RenderMaxIterationLimitException();

        preg_match_all("/\{\{[a-zA-Z_0-9:.#@]+\}\}/", $layout, $layoutTags);
        $layoutTags = $layoutTags[0];
        foreach ($layoutTags as $layoutTag) {
            preg_match('/[a-zA-Z_0-9:.#@]+/', $layoutTag, $tag);
            $tag = $tag[0];

            if (str_starts_with($tag, '@')) {
                $html = match ($tag) {
                    '@csrf_token' => '<input name="csrf_token" type="hidden" value="'.$app->security->getCsrfToken().'"/>',
                    default => '',
                };
                $layout = str_replace($layoutTag, $html, $layout);
            } else if ($tag === 'content') {
                ob_start();
                $templatePath = $app->rootDir . $this->config->get('RENDER_DIR') . '/' . (($otherPath) ?? $this->config->get('RENDER_DEFAULT_DIR')) . '/' . $this->config->get('RENDER_TEMPLATES_DIR') . '/' . $templateName . '.php';
                if (!file_exists($templatePath)) {
                    if ($notfound) {
                        throw new HttpRouteNotFoundException();
                    } else {
                        throw new RenderFileTemplateNotFoundException('File ' . $templateName . '.php not found in ' . $templatePath, true);
                    }
                }
                extract($args);
                require $templatePath;
                $templateContent = ob_get_clean();
                $layout = str_replace($layoutTag, $templateContent, $layout);
            } else {
                $expTagContent = explode(':', $tag);
                $type = $expTagContent[0];
                $blockName = $expTagContent[1];
                if ($type == 'block') {
                    ob_start();
                    $blockName = str_replace('.', '/', $blockName);
                    $blockPath = $app->rootDir . $this->config->get('RENDER_DIR') . '/' . (($otherPath) ?? $this->config->get('RENDER_DEFAULT_DIR')) . '/' . $this->config->get('RENDER_BLOCKS_DIR') . '/' . $blockName . '.block.php';
                    if (!file_exists($blockPath)) throw new RenderFileBlockNotFoundException('File ' . $blockName . '.php not found in ' . $blockPath, true);
                    require $blockPath;
                    $block = ob_get_clean();
                    $layout = str_replace($layoutTag, $block, $layout);
                }
                if (str_starts_with($type, '#')) {
                    $layout = str_replace($tag, '', $layout);
                }
            }
        }
        preg_match_all("/\{\{[a-zA-Z_0-9:.#@]+\}\}/", $layout, $layoutTags);
        $layoutTags = $layoutTags[0];
        if (count($layoutTags) > 0) {
            return $this->loadTemplates($templateName, $layout, $args, $iteration, $notfound, $otherPath);
        }
        return $layout;
    }
}