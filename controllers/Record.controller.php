<?php

class RecordController
{

    public function addForm()
    {
        $userId = $_SESSION['user_id'];

        if (isset($_GET["patient"])) {
            $selected = $_GET["patient"];
        }

        $model = new Doctor($userId);
        $patients = $model->getPatients();
        

        require 'views/doctor/add_record.php';
    }

    public function editForm($recordId)
    {
        $userId = $_SESSION['user_id'];

        $model = new MedicalRecord(id: $recordId, doctorId: $userId);
        $record = $model->getRecordById();

        require 'views/doctor/edit_record.php';
    }

    // create
    public function createRecord()
    {
        $userId = $_SESSION['user_id'];

        $patientId = $_POST['patientId'] ?? null;
        $diagnosis = $_POST['diagnosis'] ?? null;
        $notes = $_POST['notes'] ?? null;
        $visitDate = $_POST['visitDate'] ?? null;

        // Validate required fields
        if (!$patientId || !$diagnosis || !$visitDate) {
            echo "Missing required fields.";
            return;
        }
        // todo: add validation
        // todo: check if $patientId is back to a patient

        $model = new MedicalRecord(
            patientId: $patientId,
            doctorId: $userId,
            diagnosis: $diagnosis,
            notes: $notes,
            visitDate: $visitDate
        );

        $success = $model->createRecord();

        if (!$success) {
            echo "Failed to create record for patient ID $patientId.";
        } else {
            // echo "Record created successfully for patient ID $patientId.";
            redirect("/");
        }
    }

    // read
    public function getRecord($recordId)
    {
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
    public function updateRecord($recordId)
    {
        $userId = $_SESSION['user_id'];
        $diagnosis = $_POST['diagnosis'] ?? null;
        $notes     = $_POST['notes'] ?? null;
        // todo: add validation
        $model = new MedicalRecord(
            id: $recordId,
            doctorId: $userId,
            diagnosis: $diagnosis,
            notes: $notes
        );

        $success = $model->updateRecord();

        if (!$success) {
            echo "Update failed or record not found.";
        } else {
            // echo "Record updated successfully.";
            // redirect("/record/$recordId/details");
            redirect("/");
        }
    }

    // delete
    public function deleteRecord($recordId)
    {
        $userId = $_SESSION['user_id'];

        $model   = new MedicalRecord(id: $recordId, doctorId: $userId);
        $success = $model->deleteRecord();

        if (!$success) {
            echo "No record found with ID $recordId or insufficient permissions.";
        } else {
            // echo "Record deleted successfully.";
            redirect("/");
        }
    }
}
