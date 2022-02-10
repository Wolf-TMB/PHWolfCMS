<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperForm extends HtmlHelperBase implements HtmlHelperInterface {
    private array $inputList = [];

    public function action($action): static {
        $this->addAttr('action', $action);
        return $this;
    }

    public function method($method): static {
        $this->addAttr('method', $method);
        return $this;
    }

    public function enctype($enctype): static {
        $this->addAttr('enctype', $enctype);
        return $this;
    }

    public function inputText(string $id, string $name, bool $addLabel = false, $labelText = '', $addWrapper = true): static {
        $this->addinput('text', $id, $name, $addLabel, $labelText, $addWrapper);
        return $this;
    }


    public function inputPassword(string $id, string $name, bool $addLabel = false, $labelText = '', $addWrapper = true): static {
        $this->addinput('password', $id, $name, $addLabel, $labelText, $addWrapper);
        return $this;
    }

    public function select(string $id, string $name, array $options, bool $addLabel = false, $labelText = '', $addWrapper = true): static {
        global $app;
        $select = $app->html->select()->options($options)->name($name)->setID($id)->addClass('form-select')->getHtml();
        $this->addLabelWrapper($select, $id, $addLabel, $labelText, $addWrapper);
        return $this;
    }

	public function button(string $type, string $id = '', string $name = '') {
		global $app;
		$button = $app->html->button()->type($type)->setID($id)->name($name)->getHtml();
		$this->inputList[] = $button;
		return $this;
	}


    private function addInput(string $type, string $id, string $name, bool $addLabel = false, $labelText = '', $addWrapper = true): void {
        global $app;
        $input = $app->html->input()->type($type)->name($name)->setID($id)->addClass('form-control')->getHtml();
        $this->addLabelWrapper($input, $id, $addLabel, $labelText, $addWrapper);
    }

    private function addLabelWrapper($element, $id, $addLabel, $labelText, $addWrapper) {
        global $app;
        $label = ($addLabel) ? $app->html->label()->for($id)->addClass('form-label')->content($labelText)->getHtml() : '';
        if ($addWrapper) {
            $html = $app->html->div()->content($label . $element)->addClass('mb-3')->getHtml();
        } else {
            $html = $label . $element;
        }
        $this->inputList[] = $html;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<form $attrs>";
        $html .= implode("\r\n", $this->inputList);
        $html .= "</form>";
        return $html;
    }
}