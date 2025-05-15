<?php

use App\Models\UserModel;

$userModel = new UserModel();
$users = $userModel->getConnection()->query("SELECT id, username, email, isAdmin FROM utilizadores")->fetchAll();
require_once __DIR__ . '/../../../public/templates/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User & Category Management</title>
    <link rel="stylesheet" href="/public/css/Admin/adminpanel.css">
</head>
<body>


<!-- Main Content -->
<div class="main-content">
    <!-- User Management Section -->
    <section class="section users-section">
        <h1>User Management</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="success-msg">✅ <?= htmlspecialchars($_GET['success']) ?></p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="error-msg">❌ <?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <div class="action-bar">
            <a href="/registerAdm" class="btn add-user">+ Add User</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= $user['isAdmin'] ? 'Admin' : 'User' ?></td>
                            <td>
                                <button class="btn edit">Edit</button>
                                <form action="/deleteUserById" method="POST" data-delete style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="btn delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Category Management Section -->
    <section class="section categories-section">
        <h1>Category Management</h1>
        <div class="action-bar">
            <button class="btn add-category">+ Add Category</button>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Technology</td>
                        <td>All tech-related articles</td>
                        <td>
                            <button class="btn edit">Edit</button>
                            <button class="btn delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal hidden">
    <div class="modal-content">
        <p>Are you sure you want to delete this user?</p>
        <div class="modal-actions">
            <button id="cancelDelete" class="btn cancel">Cancel</button>
            <button id="confirmDelete" class="btn delete">Confirm</button>
        </div>
    </div>
</div>



<script>
    let currentForm = null;

    document.querySelectorAll('form[data-delete]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            currentForm = form;
            document.getElementById('deleteModal').classList.remove('hidden');
        });
    });

    document.getElementById('cancelDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').classList.add('hidden');
        currentForm = null;
    });

    document.getElementById('confirmDelete').addEventListener('click', () => {
        if (currentForm) currentForm.submit();
    });
</script>

</body>
</html>
