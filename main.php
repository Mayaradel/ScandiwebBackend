<?php
require_once 'DatabaseConnection.php';

require_once 'ProductFactory.php';
require_once 'Product.php';
require_once 'Book.php';

require_once 'DVD.php';

require_once 'Furniture.php';



header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


// Get the raw POST data
$jsonData = file_get_contents("php://input");

// Decode the JSON data
$productData = json_decode($jsonData, true);


$sku = isset($productData['sku']) ? $productData['sku'] : '';
$name = isset($productData['name']) ? $productData['name'] : '';
$price = isset($productData['price']) ? $productData['price'] : '';
$type = isset($productData['type']) ? $productData['type'] : '';
$weight = isset($productData['weight']) ? $productData['weight'] : '';
$size = isset($productData['size']) ? $productData['size'] : '';
$length = isset($productData['length']) ? $productData['length'] : '';
$width = isset($productData['width']) ? $productData['width'] : '';
$additionalInfo = isset($productData['additionalInfo']) ? $productData['additionalInfo'] : '';

$product = ProductFactory::createProduct($sku,$name,$price,$type,$additionalInfo);

$product->saveToDatabase(); // Output: Data saved to the database successfully!




?>