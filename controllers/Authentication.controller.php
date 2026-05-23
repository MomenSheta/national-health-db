<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "Validation.controller.php";
require_once "../models/User.model.php";
class AuthenticationController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $validator = new ValidationController();
            $validationErrors = $validator->validateLogin($email, $password);

            if (!empty($validationErrors)) {
                $_SESSION['error'] = $validationErrors[0]; 
                header("Location: ../views/home.php");
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
                    header("Location: ../views/dashboard_admin.php");
                } elseif ($userData['role'] === 'doctor') {
                    header("Location: ../views/dashboard_doctor.php");
                } elseif ($userData['role'] === 'patient') {
                    header("Location: ../views/dashboard_patient.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Email or password is incorrect";
                header("Location: ../views/home.php");
                exit();
            }
        }
    }

    public function logout() {
        $userModel = new User();
        $userModel->logout();
        header("Location: ../views/home.php");
        exit();
    }
}