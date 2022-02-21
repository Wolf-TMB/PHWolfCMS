<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperForm extends HtmlHelperBase implements HtmlHelperInterface {
	private array $inputList = [];

	/**
	 * Данный метод устанавливает значение атрибута action
	 * @param string $action значение атрибута action
	 * @return $this
	 */
	public function action(string $action): static {
		$this->addAttr('action', $action);
		return $this;
	}


	/**
	 * Данный метод добавляет скрытое поле с csrf токеном
	 * @return $this
	 */
	public function csrf_token(): static {
		global $app;
		$this->addInput('hidden', 'csrf_token', 'csrf_token', false, '', ['value' => $app->security->getCsrfToken()]);
		return $this;
	}

	/**
	 * Данный метод устанавливает значение атрибута method
	 * @param string $method значение атрибута method
	 * @return $this
	 */
	public function method(string $method): static {
		$this->addAttr('method', $method);
		return $this;
	}

	/**
	 * Данный метод устанавливает значение атрибута enctype
	 * @param string $enctype значение атрибута enctype
	 * @return $this
	 */
	public function enctype(string $enctype): static {
		$this->addAttr('enctype', $enctype);
		return $this;
	}

	/**
	 * Данный метод добавляет текстовое поле ввода в форму
	 * @param string $id id текстового поля
	 * @param string $name name текстового поля
	 * @param bool $addLabel (опционально) добавлять ли label для данного текстового поля
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 * @return $this
	 */
	public function inputText(string $id, string $name, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): static {
		$this->addinput('text', $id, $name, $addLabel, $labelText, $attrs, $addWrapper);
		return $this;
	}

    public function addElement(string $element, bool $addWrapper): static {
        if ($addWrapper)
        $this->inputList[] = $element;
        return $this;
    }

	/**
	 * Данный метод добавляет текстовое поле ввода пароля в форму
	 * @param string $id id текстового поля
	 * @param string $name name текстового поля
	 * @param bool $addLabel (опционально) добавлять ли label для данного текстового поля
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 * @return $this
	 */
	public function inputPassword(string $id, string $name, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): static {
		$this->addinput('password', $id, $name, $addLabel, $labelText, $attrs, $addWrapper);
		return $this;
	}

	/**
	 * Данный метод добавляет поле загрузки файла в форму
	 * @param string $id id поля загрузки файла
	 * @param string $name name поля загрузки файла
	 * @param bool $addLabel (опционально) добавлять ли label для данного поле загрузки файла
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 * @return $this
	 */
	public function inputFile(string $id, string $name, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): static {
		$this->addinput('file', $id, $name, $addLabel, $labelText, $attrs, $addWrapper);
		return $this;
	}

	/**
	 * Данный метод добавляет текстовое поле загрузки файла в форму
	 * @param string $id id чекбокса
	 * @param string $name name чекбокса
	 * @param bool $addLabel (опционально) добавлять ли label для данного чекбокса
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 * @return $this
	 */
	public function checkbox(string $id, string $name, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): static {
		$this->addinput('checkbox', $id, $name, $addLabel, $labelText, $attrs, $addWrapper);
		return $this;
	}



	/**
	 * Добавляет выпадающий список в форму
	 * @param string $id id выпадающего списка
	 * @param string $name name выпадающего списка
	 * @param array $options элементы выпадающего списка в виде массива, пример: array(1 => 1, 2 => [2, 'options' => ['selected']])
	 * @param bool $addLabel (опционально) добавлять ли label для данного текстового поля
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 * @return $this
	 */
	public function select(string $id, string $name, array $options, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): static {
		global $app;
		$select = $app->html->select()->options($options)->name($name)->setID($id)->addClass('form-select');
		if (!empty($attrs)) {
			foreach ($attrs as $key => $value) {
				if ($key == 'class') {
					$select->addClass($value);
				} else {
					$select->addAttr($key, $value);
				}
			}
		}
		$select = $select->getHtml();

		$this->addLabelWrapper($select, 'select', $id, $addLabel, $labelText, $addWrapper);
		return $this;
	}

	/**
	 * Добавляет кнопку в форму
	 * @param string $content текст кнопки
	 * @param string $classList (опционально) классы кнопки
	 * @param string $id (опционально) id кнопки
	 * @param string $name (опционально) name кнопки
	 * @param string $type (опционально) type кнопки, по умолчанию submit
	 * @return $this
	 */
	public function button(string $content, string $classList = '', string $id = '', string $name = '', string $type = 'submit'): static {
		global $app;
		$button = $app->html->button()->type($type)->content($content);
		if (strlen($classList) > 0) $button->addClass($classList);
		if (strlen($id) > 0) $button->setID($id);
		if (strlen($name) > 0) $button->name($name);
		$this->inputList[] = $button->getHtml();
		return $this;
	}

	/**
	 * Данный метод добавляет input в форму
	 * @param string $type тип поля ввода
	 * @param string $id id поля ввода
	 * @param string $name name поля ввода
	 * @param bool $addLabel (опционально) добавлять ли label для данного текстового поля
	 * @param string $labelText (опционально) текст label
	 * @param array $attrs (опционально) дополнительные атрибуты
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 */
	private function addInput(string $type, string $id, string $name, bool $addLabel = false, string $labelText = '', array $attrs = [], bool $addWrapper = true): void {
		global $app;
		$input = $app->html->input()->type($type)->name($name)->setID($id);
        if ($type == 'file' || $type == 'text' || $type == 'password') $input->addClass('form-control');
        if ($type == 'checkbox') $input->addClass('form-check-input');
		if (!empty($attrs)) {
			foreach ($attrs as $key => $value) {
				if ($key == 'class') {
					$input->addClass($value);
				} else {
					$input->addAttr($key, $value);
				}
			}
		}
		$input = $input->getHtml();
		$this->addLabelWrapper($input, $type, $id, $addLabel, $labelText, $addWrapper);
	}

	/**
	 * Добавляет label и div к элементу, если необходимо
	 * @param string $element элемент
	 * @param string $id id элемента
	 * @param string $type тип элемента
	 * @param bool $addLabel (опционально) добавлять ли label для данного текстового поля
	 * @param string $labelText (опционально) текст label
	 * @param bool $addWrapper (опционально) добавлять ли div, рекомендуется
	 */
	private function addLabelWrapper(string $element, string $type, string $id, bool $addLabel, string $labelText, bool $addWrapper) {
		global $app;
        $label = '';
        if ($addLabel) {
            $labelObj = $app->html->label()->for($id)->content($labelText);
            if ($type == 'file' || $type == 'text' || $type == 'password' || $type == 'select') $labelObj->addClass('form-label');
            if ($type == 'checkbox') $labelObj->addClass('form-check-label');
            $label = $labelObj->getHtml();
        }
		if ($addWrapper) {
			$html = $app->html->div()->content($label . $element)->addClass('mb-3')->getHtml();
		} else {
			$html = $label . $element;
		}
		$this->inputList[] = $html;
	}

	/**
	 * Данный метод возвращает код элемента в виде HTML
	 * @return string
	 */
	#[Pure] public function getHtml(): string {
		$attrs = $this->getAttrsString();
		$html = "<form $attrs>";
		$html .= implode("\r\n", $this->inputList);
		$html .= "</form>";
		return $html;
	}
}