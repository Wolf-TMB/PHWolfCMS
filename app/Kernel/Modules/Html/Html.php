<?php

namespace PHWolfCMS\Kernel\Modules\Html;

use JetBrains\PhpStorm\Pure;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperDiv;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperForm;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperLabel;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperInput;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperButton;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperOption;
use PHWolfCMS\Kernel\Modules\Html\HtmlHelpers\HtmlHelperSelect;

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