<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperInput extends HtmlHelperBase implements HtmlHelperInterface {

    public function type(string $type): static {
        $this->addAttr('type', $type);
        return $this;
    }

    public function name(string $name): static {
        $this->addAttr('name', $name);
        return $this;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        return "<input $attrs />";
    }
}