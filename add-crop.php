<?php
// Include the database connection
include('Connection.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $crop_Id = $_POST['crop_id'];
    $crop_name = $_POST['crop_name'];
    $season = $_POST['season'];
    $description = $_POST['description'];

    // Handle file upload
    if (isset($_FILES["crop_image"]) && $_FILES["crop_image"]["error"] == 0) {
        $target_dir = "img/"; // Directory to save uploaded images
        $imageFileType = strtolower(pathinfo($_FILES["crop_image"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid("crop_", true) . "." . $imageFileType; // Unique file name

        // Validate the file
        if (getimagesize($_FILES["crop_image"]["tmp_name"]) === false) {
            echo "<p style='color: red;'>File is not an image.</p>";
        } elseif ($_FILES["crop_image"]["size"] > 5000000) {
            echo "<p style='color: red;'>File is too large. Maximum size is 5MB.</p>";
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "<p style='color: red;'>Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
        } elseif (!move_uploaded_file($_FILES["crop_image"]["tmp_name"], $target_file)) {
            echo "<p style='color: red;'>There was an error uploading your file.</p>";
        } else {
            // File is valid, insert data into the database
            $stmt = $connection->prepare("INSERT INTO farmer_crop (Crop_Id, Crop_Name, Season, Description, Crop_Image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $crop_Id, $crop_name, $season, $description, $target_file);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Crop registered successfully!</p>";
            } else {
                echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }
    } else {
        echo "<p style='color: red;'>No file uploaded or there was an upload error.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Crop</title>
    <link rel="stylesheet" href="Agent Directory.css">
</head>
<body>

<div class="container">
    <header>
        <button class="back-button" onclick="window.location.href='farmer-crop.php'">Back</button>
        <h1>Crop Registration</h1>
    </header>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="crop-id">Crop ID:</label>
        <input type="text" id="crop-id" name="crop_id" required>

        <label for="crop-name">Crop Name:</label>
        <input type="text" id="crop-name" name="crop_name" required>

        <label for="season">Season:</label>
        <input type="text" id="season" name="season" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="image-upload">Crop Image:</label>
        <input type="file" id="image-upload" name="crop_image" accept="image/*" required>

        <button type="submit">Register Crop</button>
    </form>
</div>

</body>
</html>
