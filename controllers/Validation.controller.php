<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ValidationController {

    public function validateLogin($email, $password) {
        $errors = [];

        if (empty($email)) {
            $errors[] = "Please enter your email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid";
        }

        if (empty($password)) {
            $errors[] = "Please enter your password";
        }

        return $errors;
    }

    public function validateRegistration($name, $email, $password, $phone) {
        $errors = [];

        if (empty($name) || strlen($name) < 3) {
            $errors[] = "Name must be at least 3 characters.";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }

        if (empty($password) || strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        if (!empty($phone) && !preg_match('/^[0-9]{10,14}$/', $phone)) {
            $errors[] = "Phone number must be digits only (10-14 digits).";
        }

        return $errors;
    }

    public static function checkAccess($allowedRole) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            $_SESSION['error'] = "Please login first.";
            header("Location: ../views/home.php");
            exit();
        }

        if ($_SESSION['user_role'] !== $allowedRole) {
            $_SESSION['error'] = "Unauthorized access!";
            header("Location: ../views/home.php");
            exit();
        }
    }
}