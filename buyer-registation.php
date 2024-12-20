<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FarmerConnect";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
     $buyer_id = $_POST['buyer_id'];
    $buyer_name = $_POST['buyer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] == 0) {
        // Get image details
        $image_name = $_FILES['upload_image']['name'];
        $image_tmp_name = $_FILES['upload_image']['tmp_name'];
        $upload_dir = 'img/';
        $image_path = $upload_dir . uniqid('buyer_', true) . '.' . pathinfo($image_name, PATHINFO_EXTENSION);

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($image_tmp_name, $image_path)) {
            echo "<p style='color: red;'>Error uploading image.</p>";
        }
    }

    // Prepare SQL statement
    $stmt = $connection->prepare("INSERT INTO buyer_directory (buyer_id,buyer_name, email, phone_number, description, upload_image) VALUES (?,?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss",$buyer_id, $buyer_name, $email, $phone_number, $description, $image_path);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Buyer registered successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Registration</title>
    <link rel="stylesheet" href="Agent Directory.css">
</head>
<body>
    <div>
        <header>
            <button onclick="window.location.href='Buyer Directory.php'">Back</button>
            <h1>Buyer Registration</h1>
        </header>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="buyer-id">Buyer ID:</label>
            <input type="int" id="buyer-id" name="buyer_id" required>
            <label for="buyer-name">Buyer Name:</label>
            <input type="text" id="buyer-name" name="buyer_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone_number" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image-upload">Upload Image:</label>
            <input type="file" id="image-upload" name="upload_image" accept="image/*">

            <button type="submit">Register Buyer</button>
        </form>
    </div>
</body>
</html>