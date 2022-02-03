<?php

namespace PHWolfCMS\Kernel;

use JetBrains\PhpStorm\Pure;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperDiv;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperForm;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperLabel;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperInput;

class Html {
    #[Pure] public function form(): HtmlHelperForm {
        return new HtmlHelperForm();
    }

    #[Pure] public function div(): HtmlHelperDiv {
        return new HtmlHelperDiv();
    }

    #[Pure] public function label(): HtmlHelperLabel {
        return new HtmlHelperLabel();
    }

    #[Pure] public function input(): HtmlHelperInput {
        return new HtmlHelperInput();
    }
}