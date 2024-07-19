<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Comment;

class CommentController extends Controller {
    /**
     * Handle the request to store a new comment.
     * 
     * @return void
     */
    public function store() {
        $data = [
            'comment' => $this->sanitizeInput($_POST['comment']),
            'post_id' => $this->sanitizeInput($_POST['post_id']),
            'user_id' => Auth::user()['id'],
        ];

        // Validate the comment data
        $this->validator->validate($data, [
            'comment' => 'required|min:10',
        ]);

        // Create the comment
        Comment::create($data);

        // Return a success response
        return $this->jsonResponse(['message' => 'Comment created successfully.'], 201);
    }
}

/**
 * The CommentController class handles operations related to comments.
 * 
 * - store: Processes the request to store a new comment, validates the input, creates the comment, and returns a success response.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on comment-related operations.
 */
