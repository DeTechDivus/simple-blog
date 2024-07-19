<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller {
    /**
     * Display the login form.
     * 
     * @return void
     */
    public function loginForm() {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     * 
     * @return void
     */
    public function login() {
        $data = [
            'email' => $this->sanitizeInput($_POST['email']),
            'password' => $this->sanitizeInput($_POST['password']),
        ];

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        // Validate the input data against the defined rules
        $this->validator->validate($data, $rules);

        // Find the user by email
        $user = User::findByEmail($data['email']);

        // Verify the password and log the user in if valid
        if ($user && password_verify($data['password'], $user['password'])) {
            Auth::login($user);
            return $this->jsonResponse(['message' => 'Login successful.'], 200);
        }
        
        // Return an error response if login fails
        return $this->jsonResponse(['errors' => ['login' => 'Invalid credentials']], 422);
    }

    /**
     * Display the registration form.
     * 
     * @return void
     */
    public function registerForm() {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     * 
     * @return void
     */
    public function register() {
        $data = [
            'username' => $this->sanitizeInput($_POST['username']),
            'email' => $this->sanitizeInput($_POST['email']),
            'password' => $this->sanitizeInput($_POST['password']),
        ];

        $rules = [
            'username' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        // Validate the input data against the defined rules
        $this->validator->validate($data, $rules);

        // Create the user
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        // Return a success response
        return $this->jsonResponse(['message' => 'Registration successful. Please login.'], 201);
    }

    /**
     * Handle the logout request.
     * 
     * @return void
     */
    public function logout() {
        Auth::logout();
        $this->redirect('/');
    }
}

/**
 * The AuthController class handles user authentication operations.
 * 
 * - loginForm: Displays the login form.
 * - login: Processes login requests, validates input, checks credentials, and logs the user in.
 * - registerForm: Displays the registration form.
 * - register: Processes registration requests, validates input, creates a new user, and returns a success response.
 * - logout: Logs the user out and redirects to the home page.
 * 
 * This class follows the Single Responsibility Principle (SRP) by focusing solely on user authentication operations.
 */
