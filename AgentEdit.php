<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmerConnect";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch agent details
$agent_id = $_GET['id'] ?? null;
if (!$agent_id) {
    die("No agent ID provided.");
}

$sql = "SELECT * FROM agent_directory WHERE agent_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$result = $stmt->get_result();
$agent = $result->fetch_assoc();
if (!$agent) {
    die("Agent not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agent_name = $_POST['agent_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];
    $image_path = $agent['upload_image']; // Default to the existing image

    // Handle image upload if a new file is provided
    if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] === 0) {
        $image_name = $_FILES['upload_image']['name'];
        $image_tmp_name = $_FILES['upload_image']['tmp_name'];
        $upload_dir = 'img/';
        $image_path = $upload_dir . uniqid('agent_', true) . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
        move_uploaded_file($image_tmp_name, $image_path);
    }

    // Update agent details in the database
    $sql = "UPDATE agent_directory SET agent_name = ?, email = ?, phone_number = ?, description = ?, upload_image = ? WHERE agent_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $agent_name, $email, $phone_number, $description, $image_path, $agent_id);

    if ($stmt->execute()) {
        header("Location: Agent Directory.php?message=Agent updated successfully");
        exit();
    } else {
        echo "Error updating agent: " . $stmt->error;
    }
}

// Close the connection
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Agent Directory.css">
    <title>Edit Agent Details</title>
</head>
<body>
    <div class="container">
        <header>
            <button class="back-button" onclick="window.location.href='Agent Directory.php'">Back</button>
            <h1>Edit Agent Details</h1>
        </header>

        <form class="edit-form" action="" method="POST" enctype="multipart/form-data">
            <label for="agent-name">Agent Name:</label>
            <input type="text" id="agent-name" name="agent_name" value="<?php echo htmlspecialchars($agent['agent_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($agent['email']); ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone_number" value="<?php echo htmlspecialchars($agent['phone_number']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($agent['description']); ?></textarea>

            <label for="image-upload">Upload New Image (Optional):</label>
            <input type="file" id="image-upload" name="upload_image" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
