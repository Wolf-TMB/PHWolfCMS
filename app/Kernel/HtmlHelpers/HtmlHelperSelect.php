<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

use JetBrains\PhpStorm\Pure;

class HtmlHelperSelect extends HtmlHelperBase implements HtmlHelperInterface {

    public function name(string $name): static {
        $this->addAttr('type', $name);
        return $this;
    }

    public function options(array $options): static {
        $this->options->options = $options;
        return $this;
    }

    public function getHtml(): string {
        global $app;
        $attrs = $this->getAttrsString();
        $html = "<select $attrs>";
        foreach ($this->options->options as $key => $value) {
            if (gettype($value) != 'array') {
                $html .= $app->html->option()->value($key)->content($value)->getHtml();
            } else {
                $html .= $app->html->option()->value($key)->content($value[0])->selected(isset($value['options']) && in_array('selected', $value['options']))->getHtml();
            }
        }
        $html .= "</select>";
        return $html;
    }
}