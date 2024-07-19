<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        <a href="/posts/create" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Post</a>
        <ul class="mt-4">
            <?php foreach ($posts as $post): ?>
                <?php if ($post['user_id'] != \App\Core\Auth::user()['id']) continue; ?>
                <li class="mb-2">
                    <a href="/posts/<?= $post['id']; ?>" class="text-blue-500 hover:underline"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <a href="/posts/<?= $post['id']; ?>/edit" class="ml-2 text-yellow-500 hover:underline">Edit</a>
                    <form action="/posts/<?= $post['id']; ?>/delete" method="post" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
