<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;

class HomeController extends Controller {
    /**
     * Display the homepage with a list of all posts.
     * 
     * @return void
     */
    public function index() {
        // Retrieve all posts from the database
        $posts = Post::findAll();
        
        // Render the 'index' view with the posts data
        return view('index', ['posts' => $posts]);
    }
}

/**
 * The HomeController class handles the display of the homepage.
 * 
 * - index: Retrieves all posts and renders the homepage view with the posts data.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on operations related to the homepage.
 */
