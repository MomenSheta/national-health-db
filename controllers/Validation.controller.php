<?php
class ValidationController {
    static public function validateLogin($email, $password) {
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

    static  public function validateRegistration($name, $email, $password, $phone, $role) {
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

        $allowedRoles = ['admin', 'doctor', 'patient'];
        if (empty($role) || !in_array($role, $allowedRoles)) {
            $errors[] = "Invalid user role selection.";
        }

        return $errors;
    }

    static public function validateRecord($diagnosis, $visitDate) {
        $errors = [];
        if (empty($diagnosis))
            $errors[] = "A valid diagnosis name is required.";

        if (empty($visitDate))
            $errors[] = "A valid visitDate is required.";
        return $errors;
    }

    static public function validatePrescription($medicationName, $dosage, $instructions) {
        $errors = [];
        if (empty($medicationName))
            $errors[] = "A valid medication name is required.";

        if (empty($dosage))
            $errors[] = "A valid dosage is required.";

        if (empty($instructions))
            $errors[] = "A valid instructions is required.";

        return $errors;
    }
}
