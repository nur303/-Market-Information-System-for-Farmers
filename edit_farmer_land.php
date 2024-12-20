<?php
// Include the database connection
include 'Connection.php'; // Ensure this is your actual database connection file

// Initialize the land variable
$land = null;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $land_id = $_POST['land_id'];
    $land_area = $_POST['land_area'];
    $area_code = $_POST['area_code'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Check if all fields are filled out
    if (empty($land_id) || empty($land_area) || empty($area_code) || empty($latitude) || empty($longitude)) {
        echo "<script>alert('Please fill all fields.');</script>";
    } else {
        // Update data in the farmer_land table
        $query = "UPDATE farmer_land SET land_area = ?, area_code = ?, latitude = ?, longitude = ? WHERE land_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssi", $land_area, $area_code, $latitude, $longitude, $land_id);

        if ($stmt->execute()) {
            // Success
            echo "<script>alert('Land record updated successfully with ID: $land_id'); window.location.href='index.php';</script>";
        } else {
            // Failure
            echo "<script>alert('Error updating record');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Fetch existing data for the land_id
if (isset($_GET['land_id'])) {
    $land_id = $_GET['land_id'];
    $query = "SELECT * FROM farmer_land WHERE land_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $land_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $land = $result->fetch_assoc();
    } else {
        echo "<script>alert('Land ID not found.'); window.location.href='index.php';</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Land</title>
    <link rel="stylesheet" href="Farmer Land.css"> <!-- Make sure the CSS file is correct -->
    <style>
        body {
            h2 {
                text-align: center;
                margin-bottom: 30px;
            }
            .submit-button {
                background-color: #4CAF50; /* Green background */
                color: white; /* White text */
                padding: 10px 20px; /* Padding for top/bottom and left/right */
                font-size: 16px; /* Font size */
                border: none; /* No border */
                border-radius: 5px; /* Rounded corners */
                cursor: pointer; /* Pointer cursor on hover */
                transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition for background color and scale */
            }
            .submit-button:hover {
                background-color: #45a049; /* Darker green on hover */
                transform: scale(1.05); /* Slightly enlarge the button on hover */
            }
            .submit-button:active {
                transform: scale(0.95); /* Slightly shrink the button when clicked */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Land</h2>
        <button class="back-button" onclick="window.location.href='Farmer Land.php'">Back</button>
        <form action="edit_farmer_land.php" method="POST">
            <div class="form-group">
                <label for="land_id">Land ID:</label>
                <input type="number" id="land_id" name="land_id" value="<?php echo $land ? $land['land_id'] : ''; ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="land_area">Land Area:</label>
                <input type="text" id="land_area" name="land_area" value="<?php echo $land ? $land['land_area'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="area_code">Area Code:</label>
                <input type="text" id="area_code" name="area_code" value="<?php echo $land ? $land['area_code'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" name="latitude" value="<?php echo $land ? $land['latitude'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" name="longitude" value="<?php echo $land ? $land['longitude'] : ''; ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Update Land</button>
            </div>
        </form>
    </div>
</body>
</html>