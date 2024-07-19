<?php

namespace App\Core;

class CSRF {
    /**
     * Generate and store a CSRF token if it doesn't already exist.
     * 
     * @return string The generated or existing CSRF token.
     */
    public static function generateToken() {
        if (!Session::get('csrf_token')) {
            $token = bin2hex(random_bytes(32));
            Session::set('csrf_token', $token);
        }
        return Session::get('csrf_token');
    }

    /**
     * Retrieve the current CSRF token from the session.
     * 
     * @return string|null The current CSRF token, or null if not set.
     */
    public static function getToken() {
        return Session::get('csrf_token');
    }

    /**
     * Check if the provided CSRF token matches the one stored in the session.
     * 
     * @param string $token The CSRF token to verify.
     * @return bool True if the tokens match, false otherwise.
     */
    public static function checkToken($token) {
        if (Session::get('csrf_token') && hash_equals(Session::get('csrf_token'), $token)) {
            return true;
        }
        return false;
    }

    /**
     * Clear the CSRF token from the session.
     */
    public static function clearToken() {
        Session::set('csrf_token', null);
    }
}

/**
 * The CSRF class provides methods for generating, retrieving, checking, and clearing CSRF tokens.
 * 
 * - generateToken: Generates a new CSRF token if it doesn't already exist and stores it in the session.
 * - getToken: Retrieves the current CSRF token from the session.
 * - checkToken: Validates the provided token against the stored token to prevent CSRF attacks.
 * - clearToken: Clears the CSRF token from the session.
 * 
 * This class follows the Singleton pattern by using static methods to ensure a single instance of CSRF token management throughout the application.
 */
