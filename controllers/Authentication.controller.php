<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "Validation.controller.php";
require_once "models/User.model.php";

class AuthenticationController {

    public function loginForm() {
        include "views/login.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $validator = new ValidationController();
            $validationErrors = $validator->validateLogin($email, $password);

            if (!empty($validationErrors)) {
                $_SESSION['error'] = $validationErrors[0];
                redirect("/");
                exit();
            }

            $userModel = new User(null, null, $email, $password);
            $userData = $userModel->login();

            if ($userData) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['user_name'] = $userData['name'];
                $_SESSION['user_role'] = $userData['role'];
                $_SESSION['is_logged_in'] = true;

                if ($userData['role'] === 'admin') {
                    redirect("/views/dashboard_admin.php");
                } elseif ($userData['role'] === 'doctor') {
                    redirect("/views/dashboard_doctor.php");
                } elseif ($userData['role'] === 'patient') {
                    redirect("/views/dashboard_patient.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Email or password is incorrect";
                redirect("/login");
                exit();
            }
        }
    }

    public function registerForm() {
        include "views/register.php";
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);
            $role = trim($_POST['role']);

            $validator = new ValidationController();
            $validationErrors = $validator->validateRegistration($name, $email, $password, $phone, $role);

            if (!empty($validationErrors)) {
                $_SESSION['error'] = $validationErrors[0];
                redirect("/views/register.php");
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $userModel = new User(null, $name, $email, $hashedPassword, $role, $phone);

            if ($userModel->createUser()) {
                $_SESSION['success'] = "Account created successfully! Please login.";
                redirect("/");
            } else {
                $_SESSION['error'] = "Something went wrong, please try again.";
                redirect("/register");
            }
            exit();
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        redirect("/logout");
        exit();
    }
}
