<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["user_id"] = "4";
$_SESSION["user_name"] = "eslam";
$_SESSION["user_role"] = "doctor";

// $_SESSION["user_id"] = "3";
// $_SESSION["user_name"] = "sickman";
// $_SESSION["user_role"] = "patient";

// todo: add auto_loader
require "core/Router.php";
require "util/Redirect.php";
require "middlewares/AuthMiddleware.php";
require "middlewares/RoleMiddleware.php";

require "models/MedicalRecord.model.php";
require "models/Prescription.model.php";
require "models/User.model.php";
require "models/Doctor.model.php";
require "models/Patient.model.php";

require "controllers/Authentication.controller.php";
require "controllers/Record.controller.php";
require "controllers/Prescription.controller.php";
require "controllers/User.controller.php";
require "controllers/Admin.controller.php";
require "controllers/Doctor.controller.php";
require "controllers/Patient.controller.php";

$router = new Router();
$router->get('/', [UserController::class, 'home'], []); // check auth
$router->get('/profile', [UserController::class, 'profile'], []); // check auth

$router->get('/register', [AuthenticationController::class, 'registerForm'], []); // should be not auth
$router->post('/register', [AuthenticationController::class, 'register'], []); // should be not auth
$router->get('/login', [AuthenticationController::class, 'loginForm'], []); // should be not auth
$router->post('/login', [AuthenticationController::class, 'login'], []); // should be not auth
$router->post('/logout', [AuthenticationController::class, 'logout'], []);  // check auth

$router->get('/my-records', [PatientController::class, 'getMyRecords'], []); // [patient]
$router->get('/my-prescriptions', [PatientController::class, 'getMyPrescriptions'], []); // [patient]

$router->get('/patients', [DoctorController::class, 'getPatients'], []); // [doctor]
$router->get('/patients/{id}/details', [DoctorController::class, 'getPatientRecords'], []); // [doctor]
$router->get('/medical-records', [DoctorController::class, 'getRecords'], []); // [doctor]

$router->get('/record/{id}/details', [RecordController::class, 'getRecord'], []); // [doctor, patient]
$router->get('/record/add', [RecordController::class, 'addForm'], []); // [doctor]
$router->post('/record/add', [RecordController::class, 'createRecord'], []); // [doctor]
$router->get('/record/{id}/edit', [RecordController::class, 'editForm'], []); // [doctor]
$router->post('/record/{id}/edit', [RecordController::class, 'updateRecord'], []); // [doctor]
$router->post('/record/{id}/delete', [RecordController::class, 'deleteRecord'], []); // [doctor]

$router->get('/presc/add/{recordId}', [PrescriptionController::class, 'addForm'], []); // [doctor]
$router->post('/presc/add/{recordId}', [PrescriptionController::class, 'createPrescription'], []); // [doctor]
$router->get('/presc/{id}/edit', [PrescriptionController::class, 'editForm'], []); // [doctor]
$router->post('/presc/{id}/edit', [PrescriptionController::class, 'updatePrescription'], []); // [doctor]
$router->post('/presc/{id}/delete', [PrescriptionController::class, 'deletePrescription'], []); // [doctor]

$router->get('/admin/users', [AdminController::class, 'allUsers'], []); // [admin]
$router->get('/admin/users/add', [AdminController::class, 'addForm'], []); // [admin]
$router->post('/admin/users/add', [AdminController::class, 'createUser'], []); // [admin]
$router->get('/admin/users/{id}/edit', [AdminController::class, 'editForm'], []); // [admin]
$router->post('/admin/users/{id}/edit', [AdminController::class, 'updateUser'], []); // [admin]
$router->post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'], []); // [admin]

$router->dispatch();

if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
    echo 'error: ' . $_SESSION['error'];
}

if (isset($_SESSION['success']) && $_SESSION['error'] != "") {
    echo 'success: ' . $_SESSION['error'];
}
