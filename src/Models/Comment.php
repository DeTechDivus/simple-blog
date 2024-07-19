<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;
use PDO;

class Comment extends Model {
    /** @var string The name of the table associated with the model. */
    protected static $table = 'comments';

    /**
     * Find comments by post ID, including the usernames of the commenters.
     * 
     * @param int $postId The ID of the post to retrieve comments for.
     * @return array An array of comments with associated usernames.
     */
    public static function findByPostId($postId) {
        $stmt = self::getDB()->prepare("
            SELECT comments.*, users.username 
            FROM " . self::$table . " 
            JOIN users ON comments.user_id = users.id 
            WHERE comments.post_id = :post_id
        ");
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

/**
 * The Comment class represents the model for comments.
 * 
 * - findByPostId: Finds comments by post ID, including the usernames of the commenters.
 * 
 * This class follows the Active Record pattern, where each model corresponds to a database table
 * and encapsulates the logic for interacting with that table.
 */
