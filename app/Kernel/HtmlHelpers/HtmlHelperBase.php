<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use stdClass;
use JetBrains\PhpStorm\Pure;

class HtmlHelperBase implements HtmlHelperInterface {

	/**
	 * Данный объект содержит параметры для генерации элемента
	 * @var object
	 */
	protected object $options;

	/**
	 * Инициализируем объект $this->options
	 */
	#[Pure] public function __construct() {
        $this->options = (object) array(
            'attributes' => [],
            'content' => ''
        );
    }

	/**
	 * Данный метод добавляет 1 или несколько классов в classList элемента, несколько классов передаются строкой через пробел
	 * @param string $class
	 * @return $this
	 */
	public function addClass(string $class): static {
        $this->addAttr('class', $class, false);
        return $this;
    }

	/**
	 * Данный метод устанавливает id элементу
	 * @param string $id
	 * @return $this
	 */
	public function setID(string $id): static {
        $this->addAttr('id', $id);
        return $this;
    }

	/**
	 * Данный метод устанавливает произвольный атрибут элементу
	 * @param string $attr атрибут
	 * @param string|int|bool $value (опционально) значение атрибута
	 * @param bool $replaceValue (опционально) перезаписывать текущее значение или добавить через пробел
	 * @return $this
	 */
	public function addAttr(string $attr, string|int|bool $value = false, bool $replaceValue = true): static {
        if ($replaceValue) {
            $this->options->attributes[$attr] = $value;
        } else {
            if (!isset($this->options->attributes[$attr])) $this->options->attributes[$attr] = '';
            $this->options->attributes[$attr] .= ' ' . $value;
        }
        return $this;
    }

	/**
	 * Данный метод возвращает значение атрибута или false, если значение не задано
	 * @param string $attr атрибут
	 * @return string|bool
	 */
	public function getAttr(string $attr) :string|bool {
        return $this->options->attributes->{$attr} ?? false;
    }

	/**
	 * Данный метод возвращает атрибуты элемента в виде строки
	 * @return string
	 */
	protected function getAttrsString(): string {
        $attrs = '';
        foreach ($this->options->attributes as $key => $value) {
            if (gettype($value) == 'boolean' && $value == true) {
                $attrs .= ' ' . $key;
            } else {
                $attrs .= ' ' . $key . '=' . '"'.$value.'"';
            }
        }
        return ltrim($attrs);
    }

	/**
	 * Данный метод возвращает код элемента в виде HTML. Реализация данного метода должны быть в классах-потомках
	 * @return string
	 */
	public function getHtml(): string {
        return "Implement getHtml() method in your class: " . __CLASS__;
    }

	/**
	 * Данный метод выводит на страницу результат работы метода $this->getHtml()
	 */
	public function print(): void {
        echo $this->getHtml();
    }
}