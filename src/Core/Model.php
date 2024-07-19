<?php

namespace App\Core;

use PDO;

abstract class Model {
    /** @var PDO|null The PDO database connection. */
    protected static $db;
    
    /** @var string The table associated with the model. */
    protected static $table;

    /**
     * Get the PDO database connection.
     * 
     * @return PDO The PDO database connection.
     */
    protected static function getDB() {
        if (!self::$db) {
            self::$db = Database::getInstance()->getConnection();
        }
        return self::$db;
    }

    /**
     * Retrieve all records from the table.
     * 
     * @return array An array of all records in the table.
     */
    public static function findAll() {
        $stmt = self::getDB()->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve a record by its ID.
     * 
     * @param int $id The ID of the record to retrieve.
     * @return array|false The record data as an associative array, or false if not found.
     */
    public static function findById($id) {
        $stmt = self::getDB()->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new record in the table.
     * 
     * @param array $data The data to insert as an associative array.
     * @return bool True on success, false on failure.
     */
    public static function create(array $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));
        $stmt = self::getDB()->prepare("INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)");
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Update a record by its ID.
     * 
     * @param int $id The ID of the record to update.
     * @param array $data The data to update as an associative array.
     * @return bool True on success, false on failure.
     */
    public static function update($id, array $data) {
        $placeholders = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $stmt = self::getDB()->prepare("UPDATE " . static::$table . " SET $placeholders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Delete a record by its ID.
     * 
     * @param int $id The ID of the record to delete.
     * @return bool True on success, false on failure.
     */
    public static function delete($id) {
        $stmt = self::getDB()->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

/**
 * The Model class provides common CRUD operations for all models.
 * 
 * - getDB: Retrieves the PDO database connection.
 * - findAll: Retrieves all records from the table.
 * - findById: Retrieves a record by its ID.
 * - create: Creates a new record in the table.
 * - update: Updates a record by its ID.
 * - delete: Deletes a record by its ID.
 * 
 * This class follows the Active Record pattern, where each model corresponds to a database table and encapsulates the logic for interacting with that table.
 */
