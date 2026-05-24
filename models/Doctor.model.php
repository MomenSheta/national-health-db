<?php

require_once "User.model.php";

class Doctor extends User {

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $phone = null) {
        parent::__construct($id, $name, $email, $password, 'doctor', $phone);
    }

    public function getMyPatients() {
        $pdo = $this->connect();
        $sql = "SELECT DISTINCT u.id, u.name, u.email, u.phone 
                FROM users u 
                JOIN medical_records m ON u.id = m.patient_id 
                WHERE m.doctor_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]); 
        return $stmt->fetchAll(); 
    }
}