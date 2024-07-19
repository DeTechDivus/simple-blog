<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= htmlspecialchars($GLOBALS['code'], ENT_QUOTES, 'UTF-8'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Error Container -->
    <div class="container mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h1 class="text-3xl font-bold mb-4">Error <?= htmlspecialchars($GLOBALS['code'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-gray-700 mb-4"><?= htmlspecialchars($GLOBALS['message'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="/" class="text-blue-500 hover:underline">Go to Home</a>
        </div>
    </div>
</body>
</html>
