<?php

namespace App\Core;

class Auth {
    /**
     * Check if the user is authenticated.
     * 
     * @return bool Returns true if a user is logged in, false otherwise.
     */
    public static function check() {
        return Session::get('user') !== null;
    }

    /**
     * Get the currently authenticated user.
     * 
     * @return mixed|null Returns the user data if logged in, null otherwise.
     */
    public static function user() {
        return Session::get('user');
    }

    /**
     * Log the user in by setting the session data.
     * 
     * @param mixed $user The user data to be stored in the session.
     */
    public static function login($user) {
        Session::set('user', $user);
    }

    /**
     * Log the user out by destroying the session.
     */
    public static function logout() {
        Session::destroy();
    }
}

/**
 * The Auth class provides methods for user authentication.
 * 
 * - check: Verifies if a user is currently authenticated.
 * - user: Retrieves the currently authenticated user.
 * - login: Logs a user in by setting session data.
 * - logout: Logs a user out by destroying the session.
 * 
 * This class follows the Singleton pattern by using static methods to ensure a single instance of user authentication management throughout the application.
 */
