<?php

namespace PHWolfCMS\Kernel\HtmlHelpers;

interface HtmlHelperInterface {
    public function getHtml() :string;
    public function print() :void;
}