<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// todo: add auto_loader
require "core/Router.php";
require "util/Redirect.php";
require "middlewares/AuthMiddleware.php";
require "middlewares/RoleMiddleware.php";
require "middlewares/PrestageMiddleware.php";

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


$adminMW = function () {
    return checkRoleMiddleware(['admin']);
};
$doctorMW = function () {
    return checkRoleMiddleware(['doctor']);
};
$patientMW = function () {
    return checkRoleMiddleware(['patient']);
};
$doctorOrPatientMW = function () {
    return checkRoleMiddleware(['admin', 'doctor']);
};

$router = new Router();
$router->get('/', [UserController::class, 'home'], ["authMiddleware"]); // check auth
$router->get('/profile', [UserController::class, 'profile'], ["authMiddleware"]); // check auth

$router->get('/register', [AuthenticationController::class, 'registerForm'], ["PrestageMiddleware"]); // not auth
$router->post('/register', [AuthenticationController::class, 'register'], ["PrestageMiddleware"]); // not auth
$router->get('/login', [AuthenticationController::class, 'loginForm'], ["PrestageMiddleware"]); // not auth
$router->post('/login', [AuthenticationController::class, 'login'], ["PrestageMiddleware"]); // not auth
$router->post('/logout', [AuthenticationController::class, 'logout'], ["authMiddleware"]);  // check auth

$router->get('/my-records', [PatientController::class, 'getMyRecords'], ["authMiddleware", $patientMW]); // [patient]
$router->get('/my-prescriptions', [PatientController::class, 'getMyPrescriptions'], ["authMiddleware", $patientMW]); // [patient]

$router->get('/medical-records', [DoctorController::class, 'getRecords'], ["authMiddleware", $doctorMW]); // [doctor]
$router->get('/patients', [DoctorController::class, 'getPatients'], ["authMiddleware", $doctorMW]); // [doctor]
$router->get('/patients/{id}/details', [DoctorController::class, 'getPatientRecords'], ["authMiddleware", $doctorMW]); // [doctor]

$router->get('/record/{id}/details', [RecordController::class, 'getRecord'], ["authMiddleware", $doctorOrPatientMW]); // [doctor, patient]
$router->get('/record/add', [RecordController::class, 'addForm'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/record/add', [RecordController::class, 'createRecord'], ["authMiddleware", $doctorMW]); // [doctor]
$router->get('/record/{id}/edit', [RecordController::class, 'editForm'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/record/{id}/edit', [RecordController::class, 'updateRecord'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/record/{id}/delete', [RecordController::class, 'deleteRecord'], ["authMiddleware", $doctorMW]); // [doctor]

$router->get('/presc/add/{recordId}', [PrescriptionController::class, 'addForm'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/presc/add/{recordId}', [PrescriptionController::class, 'createPrescription'], ["authMiddleware", $doctorMW]); // [doctor]
$router->get('/presc/{id}/edit', [PrescriptionController::class, 'editForm'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/presc/{id}/edit', [PrescriptionController::class, 'updatePrescription'], ["authMiddleware", $doctorMW]); // [doctor]
$router->post('/presc/{id}/delete', [PrescriptionController::class, 'deletePrescription'], ["authMiddleware", $doctorMW]); // [doctor]

$router->get('/admin/users', [AdminController::class, 'allUsers'], ["authMiddleware", $adminMW]); // [admin]
$router->get('/admin/users/add', [AdminController::class, 'addForm'], ["authMiddleware", $adminMW]); // [admin]
$router->post('/admin/users/add', [AdminController::class, 'createUser'], ["authMiddleware", $adminMW]); // [admin]
$router->get('/admin/users/{id}/edit', [AdminController::class, 'editForm'], ["authMiddleware", $adminMW]); // [admin]
$router->post('/admin/users/{id}/edit', [AdminController::class, 'updateUser'], ["authMiddleware", $adminMW]); // [admin]
$router->post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'], ["authMiddleware", $adminMW]); // [admin]

$router->dispatch();
