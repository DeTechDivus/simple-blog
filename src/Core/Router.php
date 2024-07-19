<?php

namespace App\Core;

class Router {
    /** @var array The array to store all registered routes. */
    protected $routes = [];

    /**
     * Register a GET route.
     * 
     * @param string $uri The URI pattern for the route.
     * @param string $controllerAction The controller and action to handle the route.
     * @param bool $isAuthRequired Whether the route requires authentication.
     */
    public function get($uri, $controllerAction, $isAuthRequired = false) {
        $this->routes['GET'][$this->formatUri($uri)] = [
            'action' => $controllerAction,
            'auth' => $isAuthRequired,
        ];
    }

    /**
     * Register a POST route.
     * 
     * @param string $uri The URI pattern for the route.
     * @param string $controllerAction The controller and action to handle the route.
     * @param bool $isAuthRequired Whether the route requires authentication.
     */
    public function post($uri, $controllerAction, $isAuthRequired = false) {
        $this->routes['POST'][$this->formatUri($uri)] = [
            'action' => $controllerAction,
            'auth' => $isAuthRequired,
        ];
    }

    /**
     * Format the URI by trimming trailing slashes.
     * 
     * @param string $uri The URI to format.
     * @return string The formatted URI.
     */
    protected function formatUri($uri) {
        return rtrim($uri, '/');
    }

    /**
     * Dispatch the current request to the appropriate route handler.
     * 
     * This method matches the current request URI and method to the registered routes,
     * checks for authentication and CSRF protection, and then calls the appropriate controller action.
     */
    public function dispatch() {
        $uri = $this->formatUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $controller) {
            if (preg_match($this->convertRouteToRegex($route), $uri, $matches)) {
                if ($controller['auth'] === true && !Auth::check()) {
                    return renderError(401, 'Unauthenticated!');
                }
                array_shift($matches);
                list($controller, $action) = explode('@', $controller['action']);
                $controller = 'App\\Controllers\\' . $controller;
                $controller = new $controller;

                // CSRF check for POST requests
                if ($method === 'POST' && !CSRF::checkToken($_POST['csrf_token'] ?? '')) {
                    return renderError(419, 'Invalid CSRF token.');
                }

                return call_user_func_array([$controller, $action], $matches);
            }
        }

        return renderError(404, 'Not Found');
    }

    /**
     * Convert a route URI with parameters to a regular expression.
     * 
     * This method converts a route URI containing placeholders (e.g., {id}) to a regular expression
     * that can be used to match request URIs.
     * 
     * @param string $route The route URI to convert.
     * @return string The regular expression for matching the route.
     */
    protected function convertRouteToRegex($route) {
        return '#^' . preg_replace('/\{[^}]+\}/', '([^/]+)', $route) . '$#';
    }
}

/**
 * The Router class handles the routing of HTTP requests to the appropriate controller actions.
 * 
 * - get: Registers a GET route.
 * - post: Registers a POST route.
 * - formatUri: Formats the URI by trimming trailing slashes.
 * - dispatch: Dispatches the current request to the appropriate route handler.
 * - convertRouteToRegex: Converts a route URI with parameters to a regular expression.
 * 
 * This class follows the Front Controller pattern, where a single point of entry handles all requests
 * and routes them to the appropriate controllers based on the URI and HTTP method.
 */
