<?php

require_once "User.model.php";

class Doctor extends User {
    public $specialization;
    public $phone;

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null) {
        parent::__construct($id, $name, $email, $password, 'doctor');
    }

    
    public function createDoctor() {
        return $this->register(); 
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

    public function updateDoctor() {
        $pdo = $this->connect();
        $sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->name, $this->email, $this->phone, $this->id]);
    }

    public function deleteDoctor() {
        $pdo = $this->connect();
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->id]);
    }
}