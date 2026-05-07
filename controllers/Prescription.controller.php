<?php

class PrescriptionController {
    // Get Methods
    public function addForm($recordId) {
        require 'views/add_prescription.php';
    }

    public function editForm($prescId) {
        $model = new Prescription(id: $prescId);
        $prescription = $model->getPrescriptionById();

        require "views/edit_prescription.php";
    }

    // Post Methods
    public function createPrescription($recordId) {
        $medicationName = $_POST['medicationName'] ?? null;
        $dosage         = $_POST['dosage'] ?? null;
        $instructions   = $_POST['instructions'] ?? null;

        if (!$medicationName || !$dosage) {
            echo "Missing required fields.";
            return;
        }

        $model = new Prescription(
            recordId: $recordId,
            medicationName: $medicationName,
            dosage: $dosage,
            instructions: $instructions
        );

        $success = $model->addPrescription();

        echo $success ? "Prescription added successfully." : "Failed to add prescription.";
    }

    public function updatePrescription($prescId) {
        $medicationName = $_POST['medicationName'] ?? null;
        $dosage = $_POST['dosage'] ?? null;
        $instructions = $_POST['instructions'] ?? null;
 
        if (!$medicationName || !$dosage) {
            echo "Missing required fields.";
            return;
        }

        $model = new Prescription(
            id: $prescId,
            medicationName: $medicationName,
            dosage: $dosage,
            instructions: $instructions
        );

        $success = $model->updatePrescription();
        echo $success ? "Prescription updated successfully." : "Failed to update prescription.";
    }

    public function deletePrescription($prescId) {
        $model = new Prescription(id: $prescId);
        $success = $model->deletePrescription();

        echo $success ? "Prescription deleted successfully." : "Failed to delete prescription.";
    }
}
