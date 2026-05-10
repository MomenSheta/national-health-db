<?php

function redirect($path) {
    $base = '/projects/national-health-db';
    header("Location: $base" . $path);
}
