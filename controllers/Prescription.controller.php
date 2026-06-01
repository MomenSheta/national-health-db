<?php

class PrescriptionController {
    // Get Methods
    public function addForm($recordId) {
        require 'views/doctor/add_prescription.php';
    }

    public function editForm($prescId) {
        $model = new Prescription(id: $prescId);
        $prescription = $model->getPrescriptionById();

        require "views/doctor/edit_prescription.php";
    }

    // POST Methods
    public function createPrescription($recordId) {
        $medicationName = $_POST['medicationName'] ?? null;
        $dosage = $_POST['dosage'] ?? null;
        $instructions = $_POST['instructions'] ?? null;

        if (!$medicationName || !$dosage || !$instructions) {
            $_SESSION['error'] = "Missing required fields.";
            redirect("/");
            exit();
        }

        $validationErrors = ValidationController::validatePrescription($medicationName, $dosage, $instructions);
        if (!empty($validationErrors)) {
            $_SESSION['error'] = $validationErrors[0];
            redirect("/");
            exit();
        }

        $model = new Prescription(
            recordId: $recordId,
            medicationName: $medicationName,
            dosage: $dosage,
            instructions: $instructions
        );

        if ($model->addPrescription()) {
            $_SESSION['success'] = "Prescription added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add prescription.";
        }
        redirect("/record/$recordId/details");
        exit();
    }

    public function updatePrescription($prescId) {
        $medicationName = $_POST['medicationName'] ?? null;
        $dosage = $_POST['dosage'] ?? null;
        $instructions = $_POST['instructions'] ?? null;

        if (!$medicationName || !$dosage || !$instructions) {
            $_SESSION['error'] = "Missing required fields.";
            redirect("/");
            exit();
        }

        $validationErrors = ValidationController::validatePrescription($medicationName, $dosage, $instructions);
        if (!empty($validationErrors)) {
            $_SESSION['error'] = $validationErrors[0];
            redirect("/");
            exit();
        }

        $model = new Prescription(
            id: $prescId,
            medicationName: $medicationName,
            dosage: $dosage,
            instructions: $instructions
        );

        if ($model->updatePrescription()) {
            $_SESSION['success'] = "Prescription updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update prescription.";
        }
        redirect("/");
        exit();
    }

    public function deletePrescription($prescId) {
        $model = new Prescription(id: $prescId);
        if ($model->deletePrescription()) {
            $_SESSION['success'] = "Prescription deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete prescription.";
        }
        redirect("/");
        exit();
    }
}
