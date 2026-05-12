<?php

class DoctorController {
    public function getPatients() {
        $userId = $_SESSION['user_id'];
        $doctor = new Doctor($userId);
        $patients = $doctor->getMyPatients();
        require 'views/show_all_patients.php';
    }

    public function getPatientRecords($patientId) {
        $userId = $_SESSION['user_id'];
        // todo: get user info also
        $model = new MedicalRecord(patientId: $patientId, doctorId: $userId);
        $records = $model->getRecordsByPatient();
        require 'views/show_patient.php';
    }
}

    // public function records($patientId) {
    //     $userId = $_SESSION['user_id'];
    //     $role = $_SESSION['role'];

    //     if ($role === 'patient' && $patientId == $userId) {
    //         $model = new MedicalRecord(patientId: $patientId);
    //     } elseif ($role === 'doctor') {
    //         $model = new MedicalRecord(patientId: $patientId, doctorId: $userId);
    //     } else {
    //         echo "you can't see records here..";
    //         return;
    //     }

    //     $records = $model->getRecordsByPatient($userId, $role);

    //     require 'views/records.php';
    // }