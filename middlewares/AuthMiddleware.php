<?php
function authMiddleware() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
        return false;
    }
    return true;
}