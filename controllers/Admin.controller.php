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
        $search_result = null;
        if (isset($_GET["search"])) {
            $search_val = $_GET["search"];
            $user = new User(name: $search_val);
            $search_result = $user->searchByName();
        } else {
            $user = new User();
        }

        $usersList = $user->getAllUsers();
        $totalUsers = count($usersList);
        $totalDoctors = 0;
        $totalPatients = 0;

        foreach ($usersList as $u) {
            $role = strtolower($u['role'] ?? '');
            if ($role === 'doctor') {
                $totalDoctors++;
            } elseif ($role === 'patient') {
                $totalPatients++;
            }
        }
        if ($search_result !== null) $usersList = $search_result;
        require "views/admin/dashboard.php";
    }

    // POST methods
    public function createUser() {
        $userName = $_POST['name'] ?? null;
        $userEmail = $_POST['email'] ?? null;
        $userPassword = $_POST['password'] ?? null;
        $userRole = $_POST['role'] ?? null;
        $userPhone = $_POST['phone'] ?? null;

        $validationErrors = ValidationController::validateRegistration($userName, $userEmail, $userPassword, $userPhone, $userRole);

        if (!empty($validationErrors)) {
            $_SESSION['error'] = $validationErrors[0];
            redirect("/admin/users/add");
            exit();
        }

        $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);
        $user = new User(
            name: $userName,
            email: $userEmail,
            password: $hashedPassword,
            role: $userRole,
            phone: $userPhone
        );

        if ($user->createUser()) {
            $_SESSION['success'] = "User created successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong, please try again.";
        }
        redirect("/");
        exit();
    }

    public function updateUser($userID) {
        $userName = $_POST['name'] ?? null;
        $userEmail = $_POST['email'] ?? null;
        $userPhone = $_POST['phone'] ?? null;

        if (!$userName || !$userEmail || !$userPhone) {
            $_SESSION['error'] = "Missing required fields.";
            redirect("/admin/users/add");
            exit();
        }

        $user = new User($userID, $userName, $userEmail, phone: $userPhone);
        if ($user->updateProfile()) {
            $_SESSION['success'] = "User updated successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong, please try again.";
        }
        redirect("/");
        exit();
    }

    public function deleteUser($userID) {
        if ($userID == $_SESSION['user_id']) {
            $_SESSION['error'] = "Can't delete yourself!";
            redirect("/");
            exit();
        }
        
        $user = new User($userID);
        if ($user->deleteUser()) {
            $_SESSION['success'] = "User deleted successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong, please try again.";
        }
        redirect("/");
        exit();
    }
}
