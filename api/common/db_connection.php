<?php
date_default_timezone_set('Asia/Manila');

$servername = '172.25.114.171\SQLEXPRESS';
$username = 'sa';
$password = 'SystemGroup2018';
$database = 'sample_system';

try {
    $conn = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $e->getMessage()
    ]);
    exit;
}
?>
