<?php

require_once "User.model.php";

class Admin extends User {
    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null) {
        parent::__construct($id, $name, $email, $password, 'admin');
    }

    public function getUserById() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$this->id]);
        return $stmt->fetch();
    }
    public function getUsers() {
        return $this->getAllUsers();
    }

    public function deleteUser() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public function addDoctor() {
        $newDoctor = new User();
        $newDoctor->id = null;
        $newDoctor->name = $this->name;
        $newDoctor->email = $this->email;
        $newDoctor->password = $this->password;
        $newDoctor->role = 'doctor';
        return $newDoctor->register();
    }

    public function addPatient() {
        $newPatien = new User();
        $newPatien->id = null;
        $newPatien->name = $this->name;
        $newPatien->email = $this->email;
        $newPatien->password = $this->password;
        $newPatien->role = 'patient';
        return $newPatien->register();
    }
}
