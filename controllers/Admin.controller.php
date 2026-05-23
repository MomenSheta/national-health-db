<?php

class AdminController {
    // get methods 
    public function addForm() {
        require "views/add_user.php";
    }

    public function editForm($userID) {
        $model = new User($userID);
        // $user = $model->getUser();
        // todo: to be continued...
        require "views/edit_user.php";
    }

    public function allUsers() {
        $user = new User();
        $usersList = $user->getAllUsers();

        // todo: make getAllUsers function public

        require "views/dashboard_admin.php";
    }

    // post methods
    public function createUser() {
        $userName = $_POST['name'] ?? null;
        $userEmail = $_POST['email'] ?? null;
        $userPassword = $_POST['password'] ?? null;
        $userRole = $_POST['role'] ?? null;
        $userPhone = $_POST['phone'] ?? null;

        // todo: add validation
        // todo: add hashing layer

        $user = new User(
            name: $userName,
            email: $userEmail,
            password: $userPassword,
            role: $userRole,
            phone: $userPhone
        );
        $user->register();
        redirect("/");
        exit;
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
    }


    public function deleteUser($userID) {
        $user = new User($userID);
        // $user->delete();
    }
}
