<?php

class Prescription extends DB {
    private $id;
    private $recordId;
    private $medicationName;
    private $dosage;
    private $instructions;

    public function __construct($id = null, $recordId = null, $medicationName = null, $dosage = null, $instructions = null) {
        $this->id = $id;
        $this->recordId = $recordId;
        $this->medicationName = $medicationName;
        $this->dosage = $dosage;
        $this->instructions = $instructions;
    }

    public function addPrescription() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("
            INSERT INTO prescriptions (record_id, medication_name, dosage, instructions) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$this->recordId, $this->medicationName, $this->dosage, $this->instructions]);
    }

    public function updatePrescription() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("
            UPDATE prescriptions 
            SET medication_name = ?, dosage = ?, instructions = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$this->medicationName, $this->dosage, $this->instructions, $this->id]);
    }

    public function getPrescriptionById() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM prescriptions WHERE id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch();
    }

    public function getPrescriptionsByRecord() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM prescriptions WHERE record_id = ?");
        $stmt->execute([$this->recordId]);
        return $stmt->fetchAll();
    }

    public function deletePrescription() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM prescriptions WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
