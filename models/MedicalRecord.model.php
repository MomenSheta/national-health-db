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
        if ($this->doctorId) {
            $stmt = $pdo->prepare("SELECT r.*, pu.name AS patient_name, du.name AS doctor_name
                                    FROM medical_records AS r
                                    JOIN users AS pu ON r.patient_id = pu.id
                                    JOIN users AS du ON r.doctor_id = du.id
                                    WHERE r.id = ? AND r.doctor_id = ?");
            $stmt->execute([$this->id, $this->doctorId]);
        } else if ($this->patientId) {
            $stmt = $pdo->prepare("SELECT r.*, pu.name AS patient_name, du.name AS doctor_name
                                    FROM medical_records AS r
                                    JOIN users AS pu ON r.patient_id = pu.id
                                    JOIN users AS du ON r.doctor_id = du.id
                                    WHERE r.id = ? AND r.patient_id = ?");
            $stmt->execute([$this->id, $this->patientId]);
        } else {
            return null;
        }
        return $stmt->fetch();
    }

    public function getRecordsByPatient() {
        $pdo = $this->connect();

        if ($this->doctorId && $this->patientId) {
            $stmt = $pdo->prepare("SELECT r.*, u.name AS patient_name
                                 FROM medical_records AS r
                                 JOIN users AS u
                                 ON r.patient_id = u.id
                                 WHERE r.patient_id = ? AND r.doctor_id = ?");
            $stmt->execute([$this->patientId, $this->doctorId]);
        } else if ($this->patientId) {
            $stmt = $pdo->prepare("SELECT r.*, u.name AS doctor_name
                                    FROM medical_records AS r
                                    JOIN users AS u
                                    ON r.doctor_id = u.id
                                    WHERE r.patient_id = ?");
            $stmt->execute([$this->patientId]);
        } else {
            return null;
        }
        return $stmt->fetchAll();
    }

    public function deleteRecord() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM medical_records WHERE id = ? AND doctor_id = ?");
        return $stmt->execute([$this->id, $this->doctorId]);
    }
}
