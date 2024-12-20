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
    $agentId = intval($data['id']);

    $stmt = $connection->prepare("DELETE FROM agent_directory WHERE agent_id = ?");
    $stmt->bind_param("i", $agentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Agent deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete agent.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request. Agent ID missing.']);
}

$connection->close();
?>
