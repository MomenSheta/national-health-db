<?php

require_once "User.model.php";

class Patient extends User {

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $phone = null) {
        parent::__construct($id, $name, $email, $password, 'patient', $phone);
    }

    public function getMyRecords() {
        $pdo = $this->connect();
        $sql = "SELECT mr.*, u.name as doctor_name 
                FROM medical_records mr
                JOIN users u ON mr.doctor_id = u.id
                WHERE mr.patient_id = ?
                ORDER BY mr.visit_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function getMyPrescriptions() {
        $pdo = $this->connect();
        $sql = "SELECT p.*, mr.visit_date, u.name as doctor_name
                FROM prescriptions p
                JOIN medical_records mr ON p.record_id = mr.id
                JOIN users u ON mr.doctor_id = u.id
                WHERE mr.patient_id = ?
                ORDER BY p.prescribed_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }
}