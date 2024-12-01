<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_log("SESSION AT ENTRY: " . print_r($_SESSION, true));
require_once __DIR__ . '/../routes/app.php';