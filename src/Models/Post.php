<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Post extends Model {
    /** @var string The name of the table associated with the model. */
    protected static $table = 'posts';

    /**
     * Find a post by its ID, including the username of the author.
     * 
     * @param int $id The ID of the post to retrieve.
     * @return array|false The post data with the author's username, or false if not found.
     */
    public static function findById($id) {
        $stmt = self::getDB()->prepare("SELECT posts.*, users.username FROM posts JOIN users ON users.id = posts.user_id WHERE posts.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve all posts, including the usernames of the authors.
     * 
     * @return array An array of all posts with the authors' usernames.
     */
    public static function findAll() {
        $stmt = self::getDB()->prepare("SELECT posts.*, users.username FROM posts JOIN users ON users.id = posts.user_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

/**
 * The Post class represents the model for posts.
 * 
 * - findById: Finds a post by its ID, including the username of the author.
 * - findAll: Retrieves all posts, including the usernames of the authors.
 * 
 * This class follows the Active Record pattern, where each model corresponds to a database table
 * and encapsulates the logic for interacting with that table.
 */
