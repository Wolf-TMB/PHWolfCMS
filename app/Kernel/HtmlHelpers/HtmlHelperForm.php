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
        global $app;
        $input = $app->html->input()->type('text')->name($name)->setID($id)->addClass('form-control')->getHtml();
        $label = ($addLabel) ? $app->html->label()->for($id)->addClass('form-label')->content($labelText)->getHtml() : '';
        if ($addWrapper) {
            $html = $app->html->div()->content($label . $input)->addClass('mb-3')->getHtml();
        } else {
            $html = $label . $input;
        }
        $this->inputList[] = $html;
        return $this;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<form $attrs>";
        $html .= implode("\r\n", $this->inputList);
        $html .= "</form>";
        return $html;
    }
}