<?php

class PatientController {
    public function getMyRecords() {
        $userId = $_SESSION['user_id'];
        $model = new MedicalRecord(patientId: $userId);
        $records = $model->getRecordsByPatient();
        // require 'views/page.php';
    }

    public function getMyPrescription() {
        $userId = $_SESSION['user_id'];
        $model = new Prescription(patientId: $userId);
        $records = $model->getPrescriptionsByPatient();
        // require 'views/page.php';
    }
}
