<?php

use App\Core\CSRF;
use App\Core\View;

/**
 * Generate a CSRF token.
 * 
 * @return string The generated CSRF token.
 */
if (!function_exists('csrf_token')) {
    function csrf_token() {
        return CSRF::generateToken();
    }
}

/**
 * Render a view with the given data.
 * 
 * @param string $view The view file to render.
 * @param array $data The data to pass to the view.
 */
if (!function_exists('view')) {
    function view($view, $data = []) {
        View::render($view, $data);
    }
}

/**
 * Render an error view with the given code and message.
 * 
 * @param int $code The HTTP status code.
 * @param string $message The error message.
 */
if (!function_exists('renderError')) {
    function renderError($code, $message) {
        View::renderError($code, $message);
    }
}
