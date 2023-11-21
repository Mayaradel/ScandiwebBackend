<?php

require_once "DatabaseConnection.php";

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Check for preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$jsonData = file_get_contents("php://input");

// Decode the JSON data
$productData = json_decode($jsonData, true);

// Get selectedProducts from POST data
$selectedProducts = isset($productData['selectedProducts']) ? $productData['selectedProducts'] : [];
//echo$_POST['selectedProducts'];

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=localhost;dbname=database2", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle empty selectedProducts array
    if (empty($selectedProducts)) {
        echo json_encode(["success" => false, "message" => "No products selected for deletion"]);
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $placeholders = implode(',', array_fill(0, count($selectedProducts), '?'));

    $sqlQuery = "DELETE FROM products WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sqlQuery);

    // Bind parameters
    $stmt->execute(array_values($selectedProducts));

    // Check if any rows were affected
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        // Respond with a success message
        echo json_encode(["success" => true, "message" => "Products deleted successfully"]);
    } else {
        // Respond with a message indicating no products were deleted
        echo json_encode(["success" => false, "message" => "No products deleted"]);
    }
} catch (PDOException $e) {
    // If there's an error, respond with a 500 Internal Server Error and send the detailed error message
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error deleting products. Details: " . $e->getMessage()]);
    error_log("Database Error: " . $e->getMessage());
}
?>
