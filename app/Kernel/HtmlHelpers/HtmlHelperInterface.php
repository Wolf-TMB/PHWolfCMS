<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

interface HtmlHelperInterface {
	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
	public function getHtml() :string;

	/**
	 * Данный метод вывод результат метода getHTML()
	 */
	public function print() :void;
}