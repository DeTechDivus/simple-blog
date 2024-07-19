<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navigation Bar -->
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold text-xl">My Blog</a>
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
        <h1 class="text-4xl font-bold mb-10 text-center">Welcome to My Blog</h1>
        
        <!-- Blog Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="/posts/<?= $post['id']; ?>" class="text-blue-500 hover:underline"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a>
                    </h2>
                    <p class="text-gray-700 mb-4 italic"><?= "Written by " . htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8'); ?>.</p>
                    <p class="text-gray-700 mb-4">
                        <?= nl2br(htmlspecialchars(substr($post['content'], 0, 100), ENT_QUOTES, 'UTF-8')); ?>...
                    </p>
                    <a href="/posts/<?= $post['id']; ?>" class="text-blue-500 hover:underline">Read more</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
