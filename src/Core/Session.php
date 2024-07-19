<?php

namespace App\Core;

class Session {
    /**
     * Start a new session or resume the existing session.
     * 
     * This method checks if a session is already started, and if not, it starts a new session.
     */
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session variable.
     * 
     * @param string $key The name of the session variable.
     * @param mixed $value The value to store in the session variable.
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session variable.
     * 
     * @param string $key The name of the session variable.
     * @return mixed|null The value of the session variable, or null if not set.
     */
    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Destroy the current session.
     * 
     * This method ends the session and clears all session data.
     */
    public static function destroy() {
        session_destroy();
    }
}

/**
 * The Session class provides methods for managing session data.
 * 
 * - start: Starts a new session or resumes the existing session.
 * - set: Sets a session variable.
 * - get: Retrieves a session variable.
 * - destroy: Destroys the current session.
 * 
 * This class follows the Singleton pattern by using static methods to ensure a single instance of session management throughout the application.
 */
