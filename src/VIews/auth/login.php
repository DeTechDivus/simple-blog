<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css"/>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navigation Bar -->
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold">Home</a>
            <div>
                <?php if (\App\Core\Auth::check()): ?>
                    <a href="/posts" class="mr-4">Posts</a>
                    <a href="/logout">Logout</a>
                <?php else: ?>
                    <a href="/login" class="mr-4">Login</a>
                    <a href="/register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
        
        <!-- Login Form -->
        <form action="/login" method="post" class="bg-white p-6 rounded shadow-md ajax-form" data-redirect-to="/posts">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            
            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
