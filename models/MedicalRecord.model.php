<?php

require "models/db.model.php";

class MedicalRecord extends DB {
    private $id;
    private $patientId;
    private $doctorId;
    private $diagnosis;
    private $notes;
    private $visitDate;

    public function __construct($id = null, $patientId = null, $doctorId = null, $diagnosis = null, $notes = null, $visitDate = null) {
        $this->id = $id;
        $this->patientId = $patientId;
        $this->doctorId = $doctorId;
        $this->diagnosis = $diagnosis;
        $this->notes = $notes;
        $this->visitDate = $visitDate;
    }

    public function createRecord() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("INSERT INTO medical_records (patient_id, doctor_id, diagnosis, notes, visit_date) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->patientId, $this->doctorId, $this->diagnosis, $this->notes, $this->visitDate]);
    }

    public function updateRecord() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("
            UPDATE medical_records 
            SET diagnosis = ?, notes = ? 
            WHERE id = ? AND doctor_id = ?
        ");
        return $stmt->execute([$this->diagnosis, $this->notes, $this->id, $this->doctorId]);
    }

    public function getRecordById() {
        $pdo = $this->connect();
        // todo: make better logic

        if ($this->doctorId) {
            $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE id = ? AND doctor_id = ?");
            $stmt->execute([$this->id, $this->doctorId]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE id = ? AND patient_id = ?");
            $stmt->execute([$this->id, $this->patientId]);
        }
        return $stmt->fetch();
    }

    public function getRecordsByPatient() {
        $pdo = $this->connect();

        // todo: make better logic
        if ($this->doctorId) {
            $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE patient_id = ? AND doctor_id = ?");
            $stmt->execute([$this->patientId, $this->doctorId]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE patient_id = ?");
            $stmt->execute([$this->patientId]);
        }
        return $stmt->fetchAll();
    }

    public function deleteRecord() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM medical_records WHERE id = ? AND doctor_id = ?");
        return $stmt->execute([$this->id, $this->doctorId]);
    }
}
