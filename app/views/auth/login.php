<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6 mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="index.php?url=auth/authenticate">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Username</label>
            <input type="text" name="username" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Password</label>
            <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Login</button>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>