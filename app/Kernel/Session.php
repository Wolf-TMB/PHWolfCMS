<?php

namespace PHWolfCMS\Kernel;

use JetBrains\PhpStorm\Pure;

class Session {
    public function __construct() {
        session_start();
        if (!$this->get('ip')) $this->set('ip', $_SERVER['REMOTE_ADDR']);
        if (!$this->verifySession() && $this->get('ip') !== false) {
            session_unset();
            header("Refresh:0");
        }
    }

    /**
     * Данный метод проверяет совпадение предыдущего ip пользователя сессии с текущим.
     *
     * @return bool
     */
    #[Pure] private function verifySession(): bool {
        return ($this->get('ip') == $_SERVER['REMOTE_ADDR']);
    }

    /**
     * Данный метод возвращает значение сессии по ключу.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): mixed {
        return ($_SESSION[$key]) ?? false;
    }

    /**
     * Данный метод устанавливает значение сессии по ключу.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool
     */
    public function set(string $key, mixed $value): bool {
        $_SESSION[$key] = $value;
        return true;
    }

    /**
     * Данный метод устанавливает "вспышку" в сессии. Это некая строка, которая будет удалена из хранилища сразу после её чтения.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function setFlash(string $key, string $value): bool {
        $flashes = ($this->get('flashes')) ?? [];
        $flashes[$key] = $value;
        return $this->set('flashes', $flashes);
    }

    /**
     * Данный метод возвращает значение "вспышки" по ключу, после чего уничтожает её в хранилище.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getFlash(string $key): mixed {
        $flashes = $this->get('flashes');
        $flash = $flashes[$key] ?? false;
        if ($flash) {
            unset($flashes[$key]);
            $this->set('flashes', $flashes);
        }
        return $flash;
    }
}