<?php

namespace PHWolfCMS\Kernel\Modules\Html\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperDiv extends HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Устанавливает контент элемента
	 * @param string $content
	 * @return $this
	 */
    public function content(string $content): static {
        $this->options->content = $content;
        return $this;
    }

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<div $attrs>";
        $html .= $this->options->content;
        $html .= "</div>";
        return  $html;
    }
}