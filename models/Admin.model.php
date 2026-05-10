<?php

require_once "User.model.php";

class Admin extends User {
    // todo: remove createAt property from the constructor (it will be added by the DB)
    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $createdAt = null) {
        parent::__construct($id, $name, $email, $password, $role, $createdAt); // todo: set the role 'admin'
    }

    // todo: add getUserByID() method

    public function getUsers() {
        return $this->getAllUsers();
    }

    public function deleteUser($targetUserId) {
        // todo: use the model properties (don't use parameters)
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$targetUserId]);
    }

    public function addDoctor($name, $email, $password, $phone) {
        // todo: use the model properties (don't use parameters)
        $newDoctor = new User(null, $name, $email, $password, 'doctor', $phone);
        return $newDoctor->register();
    }

    public function addPatient($name, $email, $password, $phone) {
        // todo: use the model properties (don't use parameters)
        $newPatient = new User(null, $name, $email, $password, 'patient', $phone);
        return $newPatient->register();
    }
}
