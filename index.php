<?php
session_start();

// todo: add auto_loader
require "core/Router.php";
require "middlewares/AuthMiddleware.php";
require "middlewares/RoleMiddleware.php";

require "models/MedicalRecord.model.php";
require "models/Prescription.model.php";
require "models/User.model.php";
require "models/Admin.model.php";
require "models/Doctor.model.php";

require "controllers/Record.controller.php";
require "controllers/Prescription.controller.php";
require "controllers/User.controller.php";

$router = new Router();
$router->get('/', [UserController::class, 'home'], []); // [doctor]

$router->get('/record/add', [RecordController::class, 'addForm'], []); // [doctor]
$router->post('/record/add', [RecordController::class, 'createRecord'], []); // [doctor]
$router->get('/record/{id}/details', [RecordController::class, 'getRecord'], []); // [doctor, patient]
$router->get('/record/{id}/edit', [RecordController::class, 'editForm'], []); // [doctor]
$router->post('/record/{id}/edit', [RecordController::class, 'updateRecord'], []); // [doctor]
$router->post('/record/{id}/delete', [RecordController::class, 'deleteRecord'], []); // [doctor]

$router->get('/presc/add/{recordId}', [PrescriptionController::class, 'addForm'], []); // [doctor]
$router->post('/presc/add/{recordId}', [PrescriptionController::class, 'createPrescription'], []); // [doctor]
$router->get('/presc/{id}/edit', [PrescriptionController::class, 'editForm'], []); // [doctor]
$router->post('/presc/{id}/edit', [PrescriptionController::class, 'updatePrescription'], []); // [doctor]
$router->post('/presc/{id}/delete', [PrescriptionController::class, 'deletePrescription'], []); // [doctor]

$router->dispatch();