<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller {
    /**
     * Display a list of all posts.
     * 
     * @return void
     */
    public function index() {
        $posts = Post::findAll();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Display a single post along with its comments.
     * 
     * @param int $id The ID of the post to display.
     * @return void
     */
    public function show($id) {
        $post = Post::findById($id);
        if (!$post) {
            return renderError(404, 'Post not found.');
        }
        return view('posts.show', [
            'post' => $post,
            'comments' => Comment::findByPostId($post['id'])
        ]);
    }

    /**
     * Display the form to create a new post.
     * 
     * @return void
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Handle the request to store a new post.
     * 
     * @return void
     */
    public function store() {
        $data = [
            'title' => $this->sanitizeInput($_POST['title']),
            'content' => $this->sanitizeInput($_POST['content']),
            'user_id' => Auth::user()['id'],
        ];

        $rules = [
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:10',
        ];

        // Validate the post data
        $this->validator->validate($data, $rules);

        // Create the post
        Post::create($data);

        // Return a success response
        return $this->jsonResponse(['message' => 'Post created successfully.'], 201);
    }

    /**
     * Display the form to edit an existing post.
     * 
     * @param int $id The ID of the post to edit.
     * @return void
     */
    public function edit($id) {
        $post = Post::findById($id);
        if (!$post || $post['user_id'] != Auth::user()['id']) {
            return renderError(404, 'Post not found.');
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Handle the request to update an existing post.
     * 
     * @param int $id The ID of the post to update.
     * @return void
     */
    public function update($id) {
        $post = Post::findById($id);
        
        if (!$post || $post['user_id'] != Auth::user()['id']) {
            return renderError(404, 'Post not found.');
        }

        $data = [
            'title' => $this->sanitizeInput($_POST['title']),
            'content' => $this->sanitizeInput($_POST['content']),
        ];

        $rules = [
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:10',
        ];

        // Validate the post data
        $this->validator->validate($data, $rules);

        // Update the post
        Post::update($id, $data);

        // Return a success response
        return $this->jsonResponse(['message' => 'Post updated successfully.'], 200);
    }

    /**
     * Handle the request to delete a post.
     * 
     * @param int $id The ID of the post to delete.
     * @return void
     */
    public function destroy($id) {
        $post = Post::findById($id);
        if (!$post) {
            return renderError(404, 'Post not found.');
        }

        // Delete the post
        Post::delete($id);

        // Return a success response
        return $this->jsonResponse(['message' => 'Post deleted successfully.'], 200);
    }
}

/**
 * The PostController class handles operations related to posts.
 * 
 * - index: Displays a list of all posts.
 * - show: Displays a single post along with its comments.
 * - create: Displays the form to create a new post.
 * - store: Processes the request to store a new post, validates input, creates the post, and returns a success response.
 * - edit: Displays the form to edit an existing post.
 * - update: Processes the request to update an existing post, validates input, updates the post, and returns a success response.
 * - destroy: Processes the request to delete a post and returns a success response.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on operations related to posts.
 */
