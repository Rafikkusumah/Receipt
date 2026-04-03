<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">Document Management System</h1>
            <nav class="space-x-4">
                <a href="/receipt/home/index" class="hover:underline">Home</a>
                <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
                    <a href="/receipt/receipt/create" class="hover:underline">Create Receipt</a>
                    <a href="/receipt/item/index" class="hover:underline">Manage Items</a>
                    <a href="/receipt/auth/logout" class="hover:underline">Logout (<?= htmlspecialchars($_SESSION['admin_username']) ?>)</a>
                <?php else: ?>
                    <a href="/receipt/auth/login" class="hover:underline">Admin Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">