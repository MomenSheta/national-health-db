<?php

require_once "User.model.php";
require_once "MedicalRecord.model.php";
require_once "Prescription.model.php";
class Dcotor extends User{


public function __construct($id = null, $name = null, $email = null, $password = null, $role = null,$createdAt=null){
    parent::__construct($id,$name,$email,$password,'doctor',$createdAt);

}


public function addRecord($patientId,$diagnosis,$notes){
   $record = new MedicalRecord(null, $patientId, $this->id, $diagnosis, $notes, date('Y-m-d'));
    return $record->createRecord();
}


public function updateDiagnosis($recordId,$newDiagnosis,$newNotes){
   $record = new MedicalRecord($recordId, null, $this->id, $newDiagnosis, $newNotes);
    return $record->updateRecord();
}

public function addPrescription($recordId,$medicationName,$dosage,$instructions){
   $prescription = new Prescription(null, $recordId, $medicationName, $dosage, $instructions);
    return $prescription->addPrescription();
        }


public function getMyPatients(){
    $pdo=$this->connect();
    $sql = "SELECT DISTINCT u.id, u.name, u.email, u.phone 
                FROM users u 
                JOIN medical_records m ON u.id = m.patient_id 
                WHERE m.doctor_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}