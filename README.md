# SimpleBlog Application - Comprehensive Documentation

## Table of Contents
1. [Introduction](#introduction)
2. [Project Structure](#project-structure)
3. [Composer](#composer)
4. [PSR-4 Autoloading](#psr-4-autoloading)
5. [Environment Variables](#environment-variables)
6. [MVC Architecture](#mvc-architecture)
7. [Core Classes and Their Explanations](#core-classes-and-their-explanations)
8. [Controllers](#controllers)
9. [Models](#models)
10. [Views](#views)
11. [Routing](#routing)
12. [Validation and CSRF Protection](#validation-and-csrf-protection)
13. [Session Management](#session-management)
14. [Error Handling](#error-handling)
15. [JavaScript and AJAX](#javascript-and-ajax)
16. [Running the Application](#running-the-application)

## Introduction
Welcome to the SimpleBlog application! This documentation is intended to provide a comprehensive guide to understanding the various components and architecture of the SimpleBlog application. Whether you're a beginner or have some experience with PHP development, this guide will help you understand the concepts, patterns, and principles used in this project.

## Project Structure
The project is organized in a way that follows the MVC (Model-View-Controller) architecture. Below is a breakdown of the project structure:

```
simpleblog/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css
│   │   ├── js/
│   │   │   └── scripts.js
│   └── index.php
├── src/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── CommentController.php
│   │   ├── HomeController.php
│   │   └── PostController.php
│   ├── Core/
│   │   ├── App.php
│   │   ├── Auth.php
│   │   ├── Controller.php
│   │   ├── CSRF.php
│   │   ├── Database.php
│   │   ├── Model.php
│   │   ├── Router.php
│   │   ├── Session.php
│   │   ├── Validator.php
│   │   └── View.php
│   ├── Models/
│   │   ├── Comment.php
│   │   ├── Post.php
│   │   └── User.php
│   ├── Views/
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── posts/
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   ├── index.php
│   │   │   └── show.php
│   │   ├── error.php
│   │   └── index.php
│   └── helpers.php
├── vendor/
├── .env
├── .rnd
├── .vscode-upload.json
├── composer.json
├── composer.lock
└── DATABASE.sql
```

## Composer
Composer is a dependency management tool for PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

### Composer.json
The `composer.json` file is where you define your project's dependencies and autoloading rules.

```json
{
    "require": {
        "vlucas/phpdotenv": "^5.4"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        },
        "files": [
            "src/helpers.php"
        ]
    }
}
```

## PSR-4 Autoloading
PSR-4 is an autoloading standard recommended by PHP-FIG (PHP Framework Interoperability Group). It maps namespaces to file paths, which helps in organizing and loading classes automatically without requiring manual `include` or `require` statements.

### Autoloading Configuration
In `composer.json`, the `autoload` section defines the autoloading rules. Here, the `psr-4` standard is used to map the `App\` namespace to the `src/` directory.

```json
"autoload": {
    "psr-4": {
        "App\\": "src/"
    },
    "files": [
        "src/helpers.php"
    ]
}
```

## Environment Variables
Environment variables are used to store configuration settings that can change based on the environment (development, testing, production). The `vlucas/phpdotenv` package is used to load environment variables from a `.env` file into the application.

### .env File
The `.env` file contains key-value pairs of configuration settings.

```
DB_HOST=127.0.0.1
DB_NAME=simpleblog
DB_USER=root
DB_PASS=secret
```

## MVC Architecture
MVC (Model-View-Controller) is a design pattern that separates an application into three main logical components:

- **Model**: Represents the data and the business logic.
- **View**: Represents the presentation layer.
- **Controller**: Handles user input and interacts with the model and view to render the final output.

### Explanation
- **Models**: Manage the data and define how the data is stored, retrieved, and manipulated.
- **Views**: Display the data to the user and send user commands to the controller.
- **Controllers**: Process the input from the view, update the model, and return the view.

## Core Classes and Their Explanations
The core classes provide the foundational functionality of the application, such as routing, session management, and database interaction.

### App.php
The `App` class is responsible for bootstrapping the application, loading routes, and dispatching requests.

### Auth.php
The `Auth` class handles user authentication, including login and logout functionality.

### Controller.php
The `Controller` class is the base class for all controllers. It provides common functionality like validation and JSON response handling.

### CSRF.php
The `CSRF` class handles Cross-Site Request Forgery protection by generating and validating CSRF tokens.

### Database.php
The `Database` class implements the Singleton pattern to provide a single instance of the database connection.

### Model.php
The `Model` class is the base class for all models. It provides common functionality for interacting with the database.

### Router.php
The `Router` class handles the routing of HTTP requests to the appropriate controllers.

### Session.php
The `Session` class manages session data, including starting, setting, getting, and destroying sessions.

### Validator.php
The `Validator` class handles input validation based on defined rules.

### View.php
The `View` class is responsible for rendering views and handling error views.

## Controllers
Controllers handle user requests, interact with models, and render views.

### AuthController.php
Handles user authentication operations, including login, registration, and logout.

### CommentController.php
Handles operations related to comments, such as storing new comments.

### HomeController.php
Handles the display of the homepage with a list of all posts.

### PostController.php
Handles CRUD operations for posts, including displaying, creating, editing, and deleting posts.

## Models
Models represent the data and the business logic.

### Comment.php
The `Comment` model manages comments, including finding comments by post ID.

### Post.php
The `Post` model manages posts, including finding posts by ID and retrieving all posts.

### User.php
The `User` model manages users, including finding users by email.

## Views
Views represent the presentation layer and are responsible for displaying data to the user.

### auth/
Contains views related to authentication, such as login and registration forms.

### posts/
Contains views related to posts, such as creating, editing, and displaying posts.

## Routing
The `Router` class defines the routes and dispatches requests to the appropriate controllers.

### Routes
Routes are defined in the `App` class and specify the HTTP method, URL pattern, and controller action.

```php
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
```

## Validation and CSRF Protection
The application includes validation and CSRF protection to ensure data integrity and security.

### Validator.php


The `Validator` class validates input data based on defined rules.

### CSRF.php
The `CSRF` class generates and validates CSRF tokens to protect against Cross-Site Request Forgery attacks.

## Session Management
The `Session` class manages session data, including starting, setting, getting, and destroying sessions.

### Session Methods
- `start()`: Starts a new session if none exists.
- `set($key, $value)`: Sets a session variable.
- `get($key)`: Retrieves a session variable.
- `destroy()`: Destroys the current session.

## Error Handling
The application includes error handling to provide meaningful error messages to the user.

### View.php
The `View` class includes a method to render error views.

```php
public static function renderError($code, $message) {
    http_response_code($code);
    $GLOBALS['code'] = $code;
    $GLOBALS['message'] = $message;
    include __DIR__ . '/../Views/error.php';
    exit();
}
```

## JavaScript and AJAX
The application uses JavaScript and AJAX for handling form submissions and displaying notifications.

### scripts.js
Contains JavaScript code for handling AJAX form submissions and displaying success/error messages.

```javascript
$(document).ready(function() {
    $('form.ajax-form').on('submit', function(e) {
        e.preventDefault();
        let $form = $(this);
        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            success: function(response) {
                if (response.message) {
                    alert(response.message);
                    if ($form.data('redirect-to') != "") {
                        window.location.href = $form.data('redirect-to');
                    }
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                }
                $('.text-red-500.text-sm.mt-1').remove();
                $.each(errors, function (field, error) {
                    console.log($form.find('[name="' + field + '"]'));
                    $form.find('[name="' + field + '"]').parent('div').append(`<div class="text-red-500 text-sm mt-1">${error}</div>`);
                });
            }
        });
    });
});
```

## Understanding XSS and CSRF Protection

### Cross-Site Scripting (XSS)
**Cross-Site Scripting (XSS)** is a type of security vulnerability that allows attackers to inject malicious scripts into web pages viewed by other users. These scripts can be executed in the context of the user's browser, leading to various harmful outcomes such as stealing session cookies, redirecting users to malicious sites, or performing actions on behalf of the user without their consent.

#### Types of XSS:
1. **Stored XSS**: The malicious script is permanently stored on the target server, such as in a database or message forum. When a user retrieves the stored data, the script executes.
2. **Reflected XSS**: The malicious script is reflected off a web application onto the user's browser. It typically occurs when a web application immediately returns user input in search results or error messages.
3. **DOM-based XSS**: The vulnerability exists in the client-side code rather than the server-side code. It happens when JavaScript on the web page modifies the DOM based on user input in an insecure way.

#### Preventing XSS:
1. **Input Sanitization**: Ensure that all user input is sanitized by escaping special characters. For instance, using `htmlspecialchars` in PHP:
   ```php
   htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
   ```
2. **Output Encoding**: Encode data before rendering it on the web page. This prevents malicious scripts from being executed.
3. **Content Security Policy (CSP)**: Implement CSP headers to restrict the sources from which scripts can be loaded.

### Cross-Site Request Forgery (CSRF)
**Cross-Site Request Forgery (CSRF)** is an attack that tricks the user into performing actions on a web application in which they are authenticated. This type of attack exploits the trust that a web application has in the user's browser.

#### How CSRF Works:
1. **User Authentication**: The user logs into a web application and receives an authentication token (e.g., a session cookie).
2. **Malicious Request**: The attacker crafts a request to perform an action on the web application and tricks the user into executing it (e.g., by clicking a link or loading an image).
3. **Unintended Action**: Because the user is authenticated, the web application processes the request, assuming it was intended by the user.

#### Preventing CSRF:
1. **CSRF Tokens**: Include unique tokens in forms and validate them on the server-side. This ensures that the request originated from the authenticated user's session.
   - Generate a token when the form is rendered:
     ```php
     $token = bin2hex(random_bytes(32));
     Session::set('csrf_token', $token);
     ```
   - Include the token in the form:
     ```html
     <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
     ```
   - Validate the token on form submission:
     ```php
     if (!CSRF::checkToken($_POST['csrf_token'])) {
         // Handle invalid token
     }
     ```
2. **SameSite Cookies**: Set the `SameSite` attribute on cookies to prevent them from being sent along with cross-site requests:
   ```php
   setcookie('session', $session_value, ['samesite' => 'Strict']);
   ```
3. **Referer Header Validation**: Check the `Referer` header to ensure that the request originated from the same site.

### Why We Use XSS and CSRF Protection
1. **Protect User Data**: Prevent attackers from stealing sensitive information such as session tokens, personal data, and financial information.
2. **Maintain User Trust**: Ensure that users can safely interact with the application without risk of their actions being hijacked by attackers.
3. **Compliance with Security Standards**: Adhering to security best practices and standards helps in protecting the application from common vulnerabilities.
4. **Prevent Unintended Actions**: Ensure that actions performed on the web application are intended by the authenticated user and not by an attacker exploiting their session.

By implementing XSS and CSRF protection measures, we can significantly enhance the security of our web application and protect both the application and its users from common attack vectors.

## Running the Application
To run the SimpleBlog application, follow these steps:

1. **Install Composer Dependencies**
   ```bash
   composer install
   ```

2. **Set Up Environment Variables**
   Create a `.env` file in the root directory and add the following variables:
   ```
   DB_HOST=127.0.0.1
   DB_NAME=simpleblog
   DB_USER=root
   DB_PASS=secret
   ```

3. **Create the Database**
   Import the `DATABASE.sql` file into your MySQL database.

4. **Start the Development Server**
   Use the built-in PHP development server to start the application:
   ```bash
   php -S localhost:8000 -t public
   ```

5. **Access the Application**
   Open your browser and navigate to `http://localhost:8000`.

Congratulations! You have successfully set up and run the SimpleBlog application. This documentation has covered the key components and architecture of the application, including Composer, PSR-4 autoloading, environment variables, MVC architecture, core classes, controllers, models, views, routing, validation, CSRF protection, session management, error handling, and JavaScript/AJAX functionality. Happy coding!