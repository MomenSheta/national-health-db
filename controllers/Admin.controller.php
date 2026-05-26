<?php

class AdminController {
    // GET methods 
    public function addForm() {
        require "views/admin/add_user.php";
    }

    public function editForm($userID) {
        $model = new User($userID);
        $user = $model->getUserById();
        require "views/admin/edit_user.php";
    }

    public function allUsers() {
        $user = new User();
        $usersList = $user->getAllUsers();

        require "views/admin/dashboard.php";
    }

    // POST methods
    public function createUser() {
        $userName = $_POST['name'] ?? null;
        $userEmail = $_POST['email'] ?? null;
        $userPassword = $_POST['password'] ?? null;
        $userRole = $_POST['role'] ?? null;
        $userPhone = $_POST['phone'] ?? null;

        // todo: add validation
        
        $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);
        $user = new User(
            name: $userName,
            email: $userEmail,
            password: $hashedPassword,
            role: $userRole,
            phone: $userPhone
        );
        $user->createUser();
        redirect("/");
        exit();
    }

    public function updateUser($userID) {
        $userName = $_POST['name'] ?? null;
        $userEmail = $_POST['email'] ?? null;
        $userPhone = $_POST['phone'] ?? null;

        // todo: add validation
        if (!$userName || !$userEmail || !$userPhone) {
            echo "Missing required fields.";
            return;
        }

        $user = new User($userID, $userName, $userEmail, phone: $userPhone);
        $user->updateProfile();

        redirect("/");
        exit();
    }

    public function deleteUser($userID) {
        $user = new User($userID);
        $user->deleteUser();
        redirect("/");
        exit();
    }
}
