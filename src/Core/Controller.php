<?php

namespace App\Core;

class Controller {
    /** @var Validator The validator instance for input validation. */
    protected $validator;

    /**
     * Controller constructor.
     * Initializes the Validator instance.
     */
    public function __construct() {
        $this->validator = new Validator();
    }

    /**
     * Redirect to a given URL.
     * 
     * @param string $url The URL to redirect to.
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    /**
     * Sanitize input data to prevent XSS attacks.
     * 
     * @param string $data The input data to sanitize.
     * @return string The sanitized data.
     */
    protected function sanitizeInput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Send a JSON response.
     * 
     * @param array $data The data to include in the JSON response.
     * @param int $statusCode The HTTP status code for the response.
     */
    protected function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        echo json_encode($data);
        http_response_code($statusCode);
        exit();
    }
}

/**
 * The Controller class serves as a base class for all application controllers.
 * 
 * - validator: An instance of the Validator class for input validation.
 * - redirect: Redirects the client to a specified URL.
 * - sanitizeInput: Sanitizes input data to prevent XSS attacks.
 * - jsonResponse: Sends a JSON response with a specified status code.
 * 
 * This class follows the Dependency Injection pattern by initializing the Validator instance in the constructor.
 */
