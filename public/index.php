<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use App\Core\App;

// Start the session
Session::start();

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Instantiate and run the application
$app = new App();
$app->run();

/**
 * This script serves as the entry point for the application.
 * 
 * - It starts the session using the Session class.
 * - Loads environment variables using the Dotenv library.
 * - Creates an instance of the App class and runs the application.
 */
