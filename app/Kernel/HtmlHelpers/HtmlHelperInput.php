<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

class HtmlHelperInput extends HtmlHelperBase implements HtmlHelperInterface {

    public function type(string $type): static {
        $this->addAttr('type', $type);
        return $this;
    }

    public function name(string $name): static {
        $this->addAttr('type', $name);
        return $this;
    }

    public function getHtml(): string {
        global $app;
        $attrs = $this->getAttrsString();
        return "<input $attrs />";
    }
}