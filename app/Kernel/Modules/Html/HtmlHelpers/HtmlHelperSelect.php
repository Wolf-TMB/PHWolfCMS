<?php

namespace PHWolfCMS\Kernel\Modules\Html\HtmlHelpers;

class HtmlHelperSelect extends HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Данный метод устанавливает имя выпадающему списку
	 * @param string $name имя элемента
	 * @return $this
	 */
	public function name(string $name): static {
        $this->addAttr('type', $name);
        return $this;
    }

	/**
	 * @param array $options элементы выпадающего списка в виде массива. array(1 => 1, 2 => [2, 'options' => ['selected']]) = <option value="1">1</option> <option value="2" selected>2</option>
	 * @return $this
	 */
	public function options(array $options): static {
        $this->options->options = $options;
        return $this;
    }

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
	public function getHtml(): string {
        global $app;
        $attrs = $this->getAttrsString();
        $html = "<select $attrs>";
        foreach ($this->options->options as $key => $value) {
            if (gettype($value) != 'array') {
                $html .= $app->html->option()->value($key)->content($value)->getHtml();
            } else {
                $html .= $app->html->option()->value($key)->content($value[0])->selected(isset($value['options']) && in_array('selected', $value['options']))->getHtml();
            }
        }
        $html .= "</select>";
        return $html;
    }
}