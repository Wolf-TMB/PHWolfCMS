<?php

namespace PHWolfCMS\Kernel;

class Security {
    public function __construct() {
        $this->generateCsrfToken();
    }

    private function generateCsrfToken() {
        global $app;
        $data = array(
            'session_id' => session_id(), //Получаем идентификатор сессии
            'remote_addr' => (@$_SERVER['REMOTE_ADDR']) ?? 'remote_addr', //ip
            'http_x_real_ip' => (@$_SERVER['HTTP_X_REAL_IP']) ?? 'http_x_real_ip', //ip
            'redirect_mmbr_addr' => (@$_SERVER['REDIRECT_MMDB_ADDR']) ?? 'redirect_mmbr_addr', //ip
            'redirect_geoio_addr' => (@$_SERVER['REDIRECT_GEOIP_ADDR']) ?? 'redirect_geoio_addr', //ip
            'redirect_geoip_longitude' => (@$_SERVER['REDIRECT_GEOIP_LONGITUDE']) ?? 'redirect_geoip_longitude', //Долгота по ip
            'redirect_geoip_latitude' => (@$_SERVER['REDIRECT_GEOIP_LATITUDE']) ?? 'redirect_geoip_latitude', //Широта по ip
            'geoip_country_name' => (@$_SERVER['GEOIP_COUNTRY_NAME']) ?? 'geoip_country_name', //Название страны по ip
            'geoip_country_code' => (@$_SERVER['GEOIP_COUNTRY_CODE']) ?? 'geoip_country_code', //Код страны по ip
            'geoip_region' => (@$_SERVER['GEOIP_REGION']) ?? 'geoip_region', //Регион по ip
            'geoip_city' => (@$_SERVER['GEOIP_CITY']) ?? 'geoip_city', //Город по ip
            'http_user_agent' => (@$_SERVER['HTTP_USER_AGENT']) ?? 'http_user_agent' //Браузер
        );

        $securityRawString = implode('--?--', $data);

        $app->session->set('csrf_token', hash('sha256', $securityRawString));
    }

    public function getCsrfToken() {
        global $app;
        return $app->session->get('csrf_token');
    }

    public function verifyCsrfToken(string|null $token): bool {
        global $app;
        if (is_null($token) || $app->session->get('csrf_token') == false || $app->session->get('csrf_token') != $token) {
            session_unset();
            return false;
        }
        return true;
    }
}