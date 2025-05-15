<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Helpers\Helpers;
use App\Core\SessionManager;

class AdminController
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function deleteUser(): void
    {
        $adminModel = new AdminModel();

        if (!$adminModel->deleteUser($this->userId)) {
            // Redirect to the PUBLIC route, passing an error flag
            header('Location: /dashboard?error=delete_failed');
            exit();
        }

        // On success, redirect to PUBLIC dashboard with a success flag
        header('Location: /dashboard?success=user_deleted');
        exit();
    }
}