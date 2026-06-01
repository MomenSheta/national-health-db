<?php
function PrestageMiddleware() {
    if (isset($_SESSION['user_id'])) {
        redirect("/");
        exit();
    }
}