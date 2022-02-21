<?php

namespace PHWolfCMS\Kernel\Modules\Html\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperLabel extends HtmlHelperBase implements HtmlHelperInterface {

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
	 *
	 * Устанавливает значение атрибута for
	 * @param string $for id элемента
	 * @return $this
	 */
    public function for(string $for): static {
        $this->addAttr('for', $for);
        return $this;
    }

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<label $attrs>";
        $html .= $this->options->content;
        $html .= "</label>";
        return $html;
    }
}