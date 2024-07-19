<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
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
        <h1 class="text-2xl font-bold mb-4">Create Post</h1>
        
        <!-- Create Post Form -->
        <form action="/posts/store" method="post" class="bg-white p-6 rounded shadow-md ajax-form" data-redirect-to="/posts">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            
            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title:</label>
                <input type="text" id="title" name="title" value="" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Content Field -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content:</label>
                <textarea id="content" name="content" required class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
        </form>

        <!-- Back to Posts Link -->
        <a href="/posts" class="block mt-4 text-blue-500">Back to Posts</a>
    </div>
</body>
</html>
