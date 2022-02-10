<?php

namespace PHWolfCMS\Kernel;

use JetBrains\PhpStorm\Pure;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperButton;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperDiv;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperForm;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperLabel;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperInput;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperOption;
use PHWolfCMS\Kernel\HtmlHelpers\HtmlHelperSelect;

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

    #[Pure] public function option(): HtmlHelperOption {
        return new HtmlHelperOption();
    }

    #[Pure] public function select(): HtmlHelperSelect {
        return new HtmlHelperSelect();
    }

    #[Pure] public function button(): HtmlHelperButton {
        return new HtmlHelperButton();
    }
}