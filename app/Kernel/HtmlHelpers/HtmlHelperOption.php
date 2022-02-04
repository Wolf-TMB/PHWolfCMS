<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperOption extends HtmlHelperBase implements HtmlHelperInterface {

    public function name(string $name): static {
        $this->addAttr('type', $name);
        return $this;
    }

    public function value(string $value): static {
        $this->addAttr('value', $value);
        return $this;
    }

    public function content(string $content): static {
        $this->options->content = $content;
        return $this;
    }

    public function selected(bool $isSelected = true): static {
        $this->addAttr('selected', $isSelected);
        return $this;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $content = $this->options->content;
        return "<option $attrs>$content</option>";
    }
}