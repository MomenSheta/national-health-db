<?php

require_once "User.model.php";

class Admin extends User {
    
    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null) {
        parent::__construct($id, $name, $email, $password, 'admin');
    }

    public function getUserById($userId) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
    
    public function getUsers() {
        return $this->getAllUsers();
    }

   
    public function addDoctor($name, $email, $password, $phone = null) {
        $newDoctor = new User(null, $name, $email, $password, 'doctor', $phone);
        return $newDoctor->createUser();
    }

    public function addPatient($name, $email, $password, $phone = null) {
        $newPatient = new User(null, $name, $email, $password, 'patient', $phone);
        return $newPatient->createUser();
    }
}