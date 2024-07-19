<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></title>
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
        <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="text-gray-700 mb-4 italic"><?= "Written by " . htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8'); ?>.</p>
        <p class="bg-white p-6 rounded shadow-md"><?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')); ?></p>
        <a href="/" class="block mt-4 text-blue-500">Back to Home</a>
    </div>

    <!-- Comments Section -->
    <div class="container mx-auto mt-10">
        <h2 class="text-xl font-bold mb-4">Comments</h2>
        <?php foreach ($comments as $comment): ?>
            <div class="bg-white p-4 mb-4 rounded shadow-md">
                <p class="text-gray-700 mb-2"><strong><?= htmlspecialchars($comment['username'], ENT_QUOTES, 'UTF-8'); ?>:</strong></p>
                <p class="text-gray-600"><?= nl2br(htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (\App\Core\Auth::check()): ?>
    <!-- Comment Form -->
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Leave a Comment</h1>
        <form id="comment-form" class="bg-white p-6 rounded shadow-md ajax-form" action="/comments/store" method="post" data-redirect-to="<?= $_SERVER['REQUEST_URI']; ?>">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <div class="mb-4">
                <label for="comment" class="block text-gray-700">Comment:</label>
                <textarea id="comment" name="comment" required class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>
