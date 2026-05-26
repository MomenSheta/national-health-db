<?php
function authMiddleware() {
    if (!isset($_SESSION['user_id'])) {
        redirect("/login");
        exit();
    }
}