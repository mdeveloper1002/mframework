<?php

namespace Mdeveloper1002\Mframework;


class View
{
    public static function render($view, $data = []): void
    {
        // RCE protection
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $view)) {
            echo "Invalid view name!";
            return;
        }

        $filePath = __DIR__ . '/../views/' . $view . '.php';

        // LFI protection
        if (!file_exists($filePath) || !is_readable($filePath)) {
            echo "View not found!";
            return;
        }

        extract($data);
        include $filePath;
        exit;
    }
}