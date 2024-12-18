<?php
// Include the database connection
include("Connection.php");

// Fetch crop data to edit
if (isset($_GET['Crop_Id'])) {
    $crop_id = intval($_GET['Crop_Id']);
    $sql = "SELECT * FROM farmer_crop WHERE Crop_Id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $crop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $crop = $result->fetch_assoc();
    } else {
        echo "<p style='color: red;'>Crop not found.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p style='color: red;'>No Crop ID provided.</p>";
    exit;
}

// Update crop data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop_name = htmlspecialchars($_POST['crop_name']);
    $season = htmlspecialchars($_POST['season']);
    $description = htmlspecialchars($_POST['description']);

    // Handle image upload
    if (isset($_FILES['crop_image']) && $_FILES['crop_image']['error'] == 0) {
        $target_dir = "img/";
        $imageFileType = strtolower(pathinfo($_FILES['crop_image']['name'], PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid("crop_", true) . "." . $imageFileType;

        // Validate file type and size
        if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"]) && $_FILES['crop_image']['size'] <= 5000000) {
            if (!move_uploaded_file($_FILES['crop_image']['tmp_name'], $target_file)) {
                echo "<p style='color: red;'>Error uploading file.</p>";
                exit;
            }
        } else {
            echo "<p style='color: red;'>Invalid file type or size. Only JPG, JPEG, PNG, and GIF under 5MB are allowed.</p>";
            exit;
        }
    } else {
        $target_file = $crop['Crop_Image']; // Retain old image if no new upload
    }

    // Update the database
    $update_sql = "UPDATE farmer_crop SET Crop_Name = ?, Season = ?, Description = ?, Crop_Image = ? WHERE Crop_Id = ?";
    $stmt = $connection->prepare($update_sql);
    $stmt->bind_param("ssssi", $crop_name, $season, $description, $target_file, $crop_id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Crop updated successfully!</p>";
        header("Location: Farmer Crop.php");
        exit;
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Agent Directory.css">
    <title>Edit Crop Details</title>
</head>
<body>
    <div class="container">
        <header>
             <div class="back-button-container">
                <button class="back-button" onclick="history.back()">&#8592; Back</button>
            </div>
            <h1>Edit Crop Details</h1>
        </header>

        <form class="edit-form" method="POST" enctype="multipart/form-data">
            <label for="crop-id">Crop Id:</label>
            <input type="text" id="crop-id" name="crop_id" value="<?php echo htmlspecialchars($crop['Crop_Id']); ?>" readonly>

            <label for="crop-name">Crop Name:</label>
            <input type="text" id="crop-name" name="crop_name" value="<?php echo htmlspecialchars($crop['Crop_Name']); ?>" required>

            <label for="season">Season:</label>
            <input type="text" id="season" name="season" value="<?php echo htmlspecialchars($crop['Season']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($crop['Description']); ?></textarea>

            <label for="image-upload">Crop Image:</label>
            <input type="file" id="image-upload" name="crop_image" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
