<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    /** @var Database|null The single instance of the Database class. */
    private static $instance = null;
    
    /** @var PDO The PDO connection instance. */
    private $pdo;

    /**
     * Database constructor.
     * Establishes a database connection using PDO.
     */
    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Get the single instance of the Database class.
     * Implements the Singleton pattern to ensure only one instance exists.
     * 
     * @return Database The single instance of the Database class.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the PDO connection instance.
     * 
     * @return PDO The PDO connection instance.
     */
    public function getConnection() {
        return $this->pdo;
    }
}

/**
 * The Database class manages the database connection using the Singleton pattern.
 * 
 * - getInstance: Returns the single instance of the Database class, creating it if necessary.
 * - getConnection: Returns the PDO connection instance.
 * 
 * This class follows the Singleton pattern to ensure only one instance of the database connection exists, which helps in managing database resources efficiently.
 */
