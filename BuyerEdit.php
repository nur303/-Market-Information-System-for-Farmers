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

// Fetch buyer details
$buyer_id = $_GET['id'] ?? null;
if (!$buyer_id) {
    die("No buyer ID provided.");
}

$sql = "SELECT * FROM buyer_directory WHERE buyer_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $buyer_id);
$stmt->execute();
$result = $stmt->get_result();
$buyer = $result->fetch_assoc();
if (!$buyer) {
    die("Buyer not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buyer_name = $_POST['buyer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];
    $image_path = $buyer['upload_image']; // Default to the existing image

    // Handle image upload if a new file is provided
    if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] === 0) {
        $image_name = $_FILES['upload_image']['name'];
        $image_tmp_name = $_FILES['upload_image']['tmp_name'];
        $upload_dir = 'img/';
        $image_path = $upload_dir . uniqid('buyer_', true) . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
        move_uploaded_file($image_tmp_name, $image_path);
    }

    // Update buyer details in the database
    $sql = "UPDATE buyer_directory SET buyer_name = ?, email = ?, phone_number = ?, description = ?, upload_image = ? WHERE buyer_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $buyer_name, $email, $phone_number, $description, $image_path, $buyer_id);

    if ($stmt->execute()) {
        header("Location: Buyer Directory.php?message=Buyer updated successfully");
        exit();
    } else {
        echo "Error updating buyer: " . $stmt->error;
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
    <title>Edit Buyer Details</title>
</head>
<body>
    <div class="container">
        <header>
            <button class="back-button" onclick="window.location.href='Buyer Directory.php'">Back</button>
            <h1>Edit Buyer Details</h1>
        </header>

        <form class="edit-form" action="" method="POST" enctype="multipart/form-data">
            <label for="buyer-name">Buyer Name:</label>
            <input type="text" id="buyer-name" name="buyer_name" value="<?php echo htmlspecialchars($buyer['buyer_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($buyer['email']); ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone_number" value="<?php echo htmlspecialchars($buyer['phone_number']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($buyer['description']); ?></textarea>

            <label for="image-upload">Upload New Image (Optional):</label>
            <input type="file" id="image-upload" name="upload_image" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
