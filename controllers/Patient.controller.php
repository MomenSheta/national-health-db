<?php

class PatientController {
    public function getMyRecords() {
        $userId = $_SESSION['user_id'];
        $model = new MedicalRecord(patientId: $userId);
        $records = $model->getRecordsByPatient();
        require 'views/patient/records.php';
    }

    public function getMyPrescriptions() {
        $userId = $_SESSION['user_id'];
        $model = new Prescription(patientId: $userId);
        $prescriptions = $model->getPrescriptionsByPatient();
        require 'views/patient/prescriptions.php';
    }
}
