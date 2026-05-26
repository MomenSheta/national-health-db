<?php

class DoctorController {
    public function getPatients() {
        $userId = $_SESSION['user_id'];
        $doctor = new Doctor($userId);
        $patients = $doctor->getMyPatients();
        require 'views/doctor/patients.php';
    }

    public function getPatientRecords($patientId) {
        $userId = $_SESSION['user_id'];

        $user_model = new User(id: $patientId);
        $patient = $user_model->getUserById();

        $record_model = new MedicalRecord(patientId: $patientId, doctorId: $userId);
        $records = $record_model->getRecordsByPatient();
        require 'views/show_patient.php';
    }
}
