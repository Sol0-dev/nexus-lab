<?php
session_start();

define('DB_HOST', 'nexus-db');
define('DB_USER', 'nexus_app');
define('DB_PASS', 'S3cur3P@ssw0rd!');
define('DB_NAME', 'nexus_portal');

function db() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die('Database connection failed: ' . $conn->connect_error);
        }
    }
    return $conn;
}

function require_login() {
    if (empty($_SESSION['uid'])) {
        header('Location: login.php?next=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}