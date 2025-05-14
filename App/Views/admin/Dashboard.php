<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User Management</title>
<link rel="stylesheet" href="../../../public/css/adminpanel.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin</h2>
        <nav>
            <a href="#">Dashboard</a>
            <a href="#" class="active">Users</a>
            <a href="#">Settings</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>User Management</h1>
        <div class="action-bar">
            <button class="btn add-user">+ Add User</button>
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
                    <!-- Example Row -->
                    <tr>
                        <td>1</td>
                        <td>Jane Doe</td>
                        <td>jane@example.com</td>
                        <td>Admin</td>
                        <td>
                            <button class="btn edit">Edit</button>
                            <button class="btn delete">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
