<?php
$DB_HOST = 'localhost';
$DB_USER = 'appuser';
$DB_PASS = 'Jaimataji@26';
$DB_NAME = 'CAT2';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$conn->set_charset('utf8mb4');
session_start();
