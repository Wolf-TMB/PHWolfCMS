<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperLabel extends HtmlHelperBase implements HtmlHelperInterface {

    public function content($content): static {
        $this->options->content = $content;
        return $this;
    }

    public function for(string $for): static {
        $this->addAttr('for', $for);
        return $this;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<label $attrs>";
        $html .= $this->options->content;
        $html .= "</label>";
        return $html;
    }
}