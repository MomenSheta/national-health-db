<?php

function fixed_path($path) {
    $base = '/national-health-db';
    return $base . $path;
}

function redirect($path) {
    $fixed_path = fixed_path($path);
    header("Location: " . $fixed_path);
}