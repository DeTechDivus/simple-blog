<?php

namespace App\Core;

class View {
    /**
     * Render a view file with the given data.
     * 
     * @param string $view The view file to render, using dot notation for directories.
     * @param array $data An associative array of data to extract and pass to the view.
     * @throws \Exception If the view file does not exist.
     */
    public static function render($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';
        
        if (!file_exists($viewPath)) {
            throw new \Exception("View file does not exist: " . $viewPath);
        }

        require_once $viewPath;
    }

    /**
     * Render an error view with the given status code and message.
     * 
     * @param int $code The HTTP status code to set.
     * @param string $message The error message to display.
     */
    public static function renderError($code, $message) {
        http_response_code($code);
        $GLOBALS['code'] = $code;
        $GLOBALS['message'] = $message;
        include __DIR__ . '/../Views/error.php';
        exit();
    }
}

/**
 * The View class provides methods for rendering view files and error views.
 * 
 * - render: Renders a specified view file with given data.
 * - renderError: Renders an error view with a specified HTTP status code and message.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on rendering views and handling errors.
 */
