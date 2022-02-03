<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperDiv extends HtmlHelperBase implements HtmlHelperInterface {
    public function content($content): static {
        $this->options->content = $content;
        return $this;
    }

    #[Pure] public function getHtml(): string {
        $attrs = $this->getAttrsString();
        $html = "<div $attrs>";
        $html .= $this->options->content;
        $html .= "</div>";
        return  $html;
    }
}