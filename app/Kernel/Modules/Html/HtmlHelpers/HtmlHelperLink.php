<?php

namespace PHWolfCMS\Kernel\Modules\Html\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperLink extends HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Устанавливает контент элемента (текст ссылки)
	 * @param string $content
	 * @return $this
	 */
	public function content(string $content): static {
		$this->options->content = $content;
		return $this;
	}

	/**
	 * Устанавливает значение атрибута href
	 * @param string $link
	 * @return $this
	 */
	public function href(string $link): static {
		$this->addAttr('href', $link);
		return $this;
	}

	/**
	 * Устанавливает значение атрибута target
	 * @param string $target
	 * @return $this
	 */
	public function target(string $target): static {
		$this->addAttr('target', $target);
		return $this;
	}

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
	#[Pure] public function getHtml(): string {
		$attrs = $this->getAttrsString();
		$html = "<a $attrs>";
		$html .= $this->options->content;
		$html .= "</a>";
		return  $html;
	}
}