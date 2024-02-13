<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../config/database.php");

$dsn = "$driver:host=$host;dbname=$database;port=$port";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$conn = new PDO($dsn, $username, $password, $options);


if (!$conn) {
    die("PDO for " . $driver . " connection failed. Error: " . var_dump($conn->errorInfo()));
}