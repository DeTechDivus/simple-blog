<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model {
    /** @var string The name of the table associated with the model. */
    protected static $table = 'users';

    /**
     * Find a user by their email address.
     * 
     * @param string $email The email address of the user to retrieve.
     * @return array|false The user data as an associative array, or false if not found.
     */
    public static function findByEmail($email) {
        $stmt = self::getDB()->prepare("SELECT * FROM " . static::$table . " WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

/**
 * The User class represents the model for users.
 * 
 * - findByEmail: Finds a user by their email address.
 * 
 * This class follows the Active Record pattern, where each model corresponds to a database table
 * and encapsulates the logic for interacting with that table.
 */
