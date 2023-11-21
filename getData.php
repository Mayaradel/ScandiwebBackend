<?php

require_once 'DatabaseConnection.php';
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    $pdo = new PDO("mysql:host=localhost;dbname=database2", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // header('Content-Type: application/json');
    echo json_encode($products);
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "Error: Unable to fetch data from the database.";
}
?>