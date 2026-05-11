<?php
session_start();

$_SESSION["user_id"] = "4";
$_SESSION["role"] = "doctor";

// todo: add auto_loader
require "core/Router.php";
require "util/Redirect.php";
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
require "controllers/Admin.controller.php";
require "controllers/Doctor.controller.php";
require "controllers/Patient.controller.php";

$router = new Router();
$router->get('/', [UserController::class, 'home'], []); // check auth

// $router->get('/login', [AuthController::class, 'loginForm'],[]);
// $router->post('/login', [AuthController::class, 'login'],[]);
// $router->get('/register', [AuthController::class, 'registerForm'],[]);
// $router->post('/register', [AuthController::class, 'register'],[]);

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

$router->get('/patients', [DoctorController::class, 'getPatients'], []); // [doctor]
$router->get('/patients/{id}', [DoctorController::class, 'getPatientRecords'], []); // [doctor]

$router->get('/myrecords', [PatientController::class, 'getMyRecords'],[]); // [patient] 
$router->get('/myprescreptions', [PatientController::class, 'getMyPrescription'],[]); // [patient] 

$router->get('/admin/users', [AdminController::class, 'allUsers'], []); // [admin]
$router->get('/admin/users/add', [AdminController::class, 'addForm'], []); // [admin]
$router->post('/admin/users/add', [AdminController::class, 'createUser'], []); // [admin]
$router->get('/admin/users/{id}/edit', [AdminController::class, 'editForm'], []); // [admin]
$router->post('/admin/users/{id}/edit', [AdminController::class, 'updateUser'], []); // [admin]

$router->dispatch();
