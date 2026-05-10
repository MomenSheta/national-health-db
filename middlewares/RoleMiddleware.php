<?php
function checkRoleMiddleware($allowedRoles = []) {
    $currentRole = $_SESSION['role'] ?? null;

    if (!in_array($currentRole, $allowedRoles)) {
        http_response_code(403);
        echo "Forbidden: role not allowed";
        return false;
    }
    return true;
}
