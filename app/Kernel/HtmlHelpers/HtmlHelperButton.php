<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperButton extends HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Устанавливает контент элемента (текст на кнопке)
	 * @param string $content
	 * @return $this
	 */
	public function content(string $content): static {
		$this->options->content = $content;
		return $this;
	}

	/**
	 * Данный метод устанавливает тип элемента
	 * @param string $type тип кнопки
	 * @return $this
	 */
	public function type(string $type): static {
		$this->addAttr('type', $type);
		return $this;
	}

	/**
	 * Данный метод устанавливает имя элемента
	 * @param string $name имя элемента
	 * @return $this
	 */
	public function name(string $name): static {
		$this->addAttr('name', $name);
		return $this;
	}

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
	#[Pure] public function getHtml(): string {
		$attrs = $this->getAttrsString();
		$html = "<button $attrs>";
		$html .= $this->options->content;
		$html .= "</button>";
		return  $html;
	}
}