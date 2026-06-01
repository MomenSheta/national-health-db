<?php

class RecordController {

    public function addForm() {
        $userId = $_SESSION['user_id'];

        if (isset($_GET["patient"])) {
            $selected = $_GET["patient"];
        }

        $model = new Doctor($userId);
        $patients = $model->getPatients();

        require 'views/doctor/add_record.php';
    }

    public function editForm($recordId) {
        $userId = $_SESSION['user_id'];

        $model = new MedicalRecord(id: $recordId, doctorId: $userId);
        $record = $model->getRecordById();

        require 'views/doctor/edit_record.php';
    }

    // create
    public function createRecord() {
        $userId = $_SESSION['user_id'];

        $patientId = $_POST['patientId'] ?? null;
        $diagnosis = $_POST['diagnosis'] ?? null;
        $notes = $_POST['notes'] ?? null;
        $visitDate = $_POST['visitDate'] ?? null;

        // Validate required fields
        if (!$patientId || !$diagnosis || !$visitDate) {
            $_SESSION['error'] = "Missing required fields.";
            redirect("/record/add");
            exit();
        }

        $validationErrors = ValidationController::validateRecord($diagnosis, $visitDate);
        if (!empty($validationErrors)) {
            $_SESSION['error'] = $validationErrors[0];
            redirect("/record/add");
            exit();
        }

        $model = new MedicalRecord(
            patientId: $patientId,
            doctorId: $userId,
            diagnosis: $diagnosis,
            notes: $notes,
            visitDate: $visitDate
        );

        if ($model->createRecord()) {
            $_SESSION['success'] = "Record created successfully for patient ID $patientId.";
        } else {
            $_SESSION['error'] = "Failed to create record for patient ID $patientId.";
        }
        redirect("/");
        exit();
    }

    // read
    public function getRecord($recordId) {
        $userId = $_SESSION['user_id'];
        $role = $_SESSION['user_role'];

        if ($role === 'patient') {
            $recordModel = new MedicalRecord(id: $recordId, patientId: $userId);
            $record = $recordModel->getRecordById();
        } elseif ($role === 'doctor') {
            $recordModel = new MedicalRecord(id: $recordId, doctorId: $userId);
            $record = $recordModel->getRecordById();
        } else {
            echo "you cant access pattients records";
            return;
        }

        if (!$record) {
            echo "No record found with ID $recordId.";
            return;
        }

        $prescriptionModel = new Prescription(recordId: $recordId);
        $prescriptions = $prescriptionModel->getPrescriptionsByRecord();

        require 'views/show_record.php';
    }

    // update
    public function updateRecord($recordId) {
        $userId = $_SESSION['user_id'];
        $diagnosis = $_POST['diagnosis'] ?? null;
        $notes = $_POST['notes'] ?? null;
        $visitDate = $_POST['visitDate'] ?? null;

        $validationErrors = ValidationController::validateRecord($diagnosis, $visitDate);
        if (!empty($validationErrors)) {
            $_SESSION['error'] = $validationErrors[0];
            redirect("/");
            exit();
        }

        $model = new MedicalRecord(
            id: $recordId,
            doctorId: $userId,
            diagnosis: $diagnosis,
            notes: $notes
        );

        if ($model->updateRecord()) {
            $_SESSION['success'] = "Record updated successfully.";
        } else {
            $_SESSION['error'] = "Update failed or record not found.";
        }
        redirect("/");
        exit();
    }

    // delete
    public function deleteRecord($recordId) {
        $userId = $_SESSION['user_id'];
        $model = new MedicalRecord(id: $recordId, doctorId: $userId);
        if ($model->deleteRecord()) {
            $_SESSION['success'] = "User deleted successfully!";
        } else {
            $_SESSION['error'] = "No record found with ID $recordId";
        }
        redirect("/");
        exit();
    }
}
