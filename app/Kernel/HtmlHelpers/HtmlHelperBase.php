<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use stdClass;
use JetBrains\PhpStorm\Pure;

class HtmlHelperBase implements HtmlHelperInterface {
    protected object $options;

    #[Pure] public function __construct() {
        $this->options = (object) array(
            'attributes' => [],
            'content' => ''
        );
    }

    public function addClass(string $class): static {
        $this->addAttr('class', $class, false);
        return $this;
    }

    public function setID(string $id): static {
        $this->addAttr('id', $id);
        return $this;
    }

    public function addAttr(string $attr, string|int $value, bool $replaceValue = true): static {
        if ($replaceValue) {
            $this->options->attributes[$attr] = $value;
        } else {
            if (!isset($this->options->attributes[$attr])) $this->options->attributes[$attr] = '';
            $this->options->attributes[$attr] .= ' ' . $value;
        }
        return $this;
    }

    public function getAttr(string $attr) :string {
        return $this->options->attributes->{$attr} ?? '';
    }

    protected function getAttrsString(): string {
        $attrs = '';
        foreach ($this->options->attributes as $key => $value) {
            $attrs .= ' ' . $key . '=' . '"'.$value.'"';
        }
        return $attrs;
    }

    public function getHtml(): string {
        return "Implement getHtml() method in your class: " . __CLASS__;
    }

    public function print(): void {
        echo $this->getHtml();
    }
}