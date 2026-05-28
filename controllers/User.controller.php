<?php

class UserController {
    public function home() {
        require 'views/home.php';
    }

    public function profile() {
        $userId = $_SESSION['user_id'] ?? null;
        $model = new User($userId);
        $user  = $model->getUserById();
        require 'views/profile.php';
    }
}
