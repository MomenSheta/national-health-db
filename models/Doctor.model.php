<?php

require_once "User.model.php";

class Doctor extends User {

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $phone = null) {
        parent::__construct($id, $name, $email, $password, 'doctor', $phone);
    }

    public function getPatients() {
        $pdo = $this->connect();
        $sql = "SELECT id, name, email, phone, created_at 
                FROM users
                WHERE role = 'patient'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMyPatients() {
        $pdo = $this->connect();
        $sql = "SELECT id, name, email, phone, created_at 
            FROM users 
            WHERE role = 'patient' 
            ORDER BY name ASC"; $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll();
    }
}
