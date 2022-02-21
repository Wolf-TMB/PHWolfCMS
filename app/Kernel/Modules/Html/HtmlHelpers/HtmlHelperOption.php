<?php

namespace PHWolfCMS\Kernel\Modules\Html\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperOption extends HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Данный метод устанавливает имя элемента
	 * @param string $name имя элемента
	 * @return $this
	 */
    public function name(string $name): static {
        $this->addAttr('type', $name);
        return $this;
    }

	/**
	 * Данный метод устанавливает значение атрибута value
	 * @param string $value значение
	 * @return $this
	 */
    public function value(string $value): static {
        $this->addAttr('value', $value);
        return $this;
    }

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
	 * Данный метод устанавливает атрибут selected или убирает, если передан параметр со значением false
	 * @param bool $isSelected (опционально), по умолчанию true
	 * @return $this
	 */
    public function selected(bool $isSelected = true): static {
        $this->addAttr('selected', $isSelected);
        return $this;
    }

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $content = $this->options->content;
        return "<option $attrs>$content</option>";
    }
}