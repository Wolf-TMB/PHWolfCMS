<?php

namespace PHWolfCMS\Kernel\Modules\PermissionManager;

use JetBrains\PhpStorm\Pure;

class PermissionsManager {
    private PagePermissions $pagePermissions;

    #[Pure] public function __construct() {
        $this->pagePermissions = new PagePermissions();
    }

    #[Pure] public function getPagePermissionsManager(): PagePermissions {
        return $this->pagePermissions;
    }
}