<?php

namespace PHWolfCMS\Kernel\Modules\PermissionManager;

class PagePermissions {
    private array $pages;

    public function __construct() {
        $this->pages = [];
    }

    public function add(string $handler, array $permissions) {
        $this->pages[$handler] = $permissions;
    }

    public function getRequiredPermissions(string $handler, array $permissions) {
        if (key_exists($handler, $this->pages)) {
            return $this->pages[$handler];
        } else {
            return [];
        }
    }

    public function checkPermissionsForPage($handler) {
        global $app;
        $access = true;
        if (key_exists($handler, $this->pages)) {
            $required_permissions = $this->pages[$handler];
            foreach ($required_permissions as $permission) {
                $access = ($access && $app->user->hasPermission($permission));
            }
        }
        return $access;
    }
}