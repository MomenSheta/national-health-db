<?php
function checkRoleMiddleware(array $allowedRoles) {
    $currentRole = $_SESSION['user_role'] ?? null;

    if (!in_array($currentRole, $allowedRoles)) {
        http_response_code(403);
        require "views/error/unauthorized.php";
        exit();
    }
}