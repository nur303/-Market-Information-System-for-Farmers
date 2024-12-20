<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmerConnect";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $buyerId = intval($data['id']);

    $stmt = $connection->prepare("DELETE FROM buyer_directory WHERE buyer_id = ?");
    $stmt->bind_param("i", $buyerId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Buyer deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete buyer.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request. Buyer ID missing.']);
}

$connection->close();
?>
