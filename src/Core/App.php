<?php

namespace App\Core;

class App {
    /** @var Router The router instance for handling routes. */
    protected $router;

    /**
     * App constructor.
     * Initializes the router and loads the routes.
     */
    public function __construct() {
        $this->router = new Router();
        $this->loadRoutes();
    }

    /**
     * Load the application routes.
     * Defines the routes and associates them with their respective controller actions.
     */
    protected function loadRoutes() {
        $this->router->get('/', 'HomeController@index');
        $this->router->get('/posts', 'PostController@index', true);
        $this->router->get('/posts/create', 'PostController@create', true);
        $this->router->post('/posts/store', 'PostController@store', true);
        $this->router->get('/posts/{id}', 'PostController@show');
        $this->router->get('/posts/{id}/edit', 'PostController@edit', true);
        $this->router->post('/posts/{id}/update', 'PostController@update', true);
        $this->router->post('/posts/{id}/delete', 'PostController@destroy', true);
        $this->router->get('/login', 'AuthController@loginForm');
        $this->router->post('/login', 'AuthController@login');
        $this->router->get('/register', 'AuthController@registerForm');
        $this->router->post('/register', 'AuthController@register');
        $this->router->get('/logout', 'AuthController@logout', true);
        $this->router->post('/comments/store', 'CommentController@store', true);
    }

    /**
     * Run the application.
     * Dispatches the current request to the appropriate route handler.
     */
    public function run() {
        $this->router->dispatch();
    }
}

/**
 * The App class represents the main application.
 * 
 * It follows the MVC pattern by routing requests to the appropriate controllers.
 * 
 * - The constructor initializes the Router and loads the defined routes.
 * - The loadRoutes method defines all application routes and associates them with controller actions.
 * - The run method starts the routing process by dispatching the current request.
 */
