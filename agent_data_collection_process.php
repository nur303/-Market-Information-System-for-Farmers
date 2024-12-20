<?php
include('connect.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle "Create Data" form submission
if (isset($_POST["create_data"])) {
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $crop_quantity = mysqli_real_escape_string($conn, $_POST["crop_quantity"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);

    $sqlInsert = "INSERT INTO agent_data_collection_db (farmer_id, crop_id, crop_quantity, location, expected_price) 
                  VALUES ('$farmer_id', '$crop_id', $crop_quantity, '$location', '$expected_price')";

    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["create_data"] = "Data Added Successfully!";
        header("Location: agent_data_collection_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

// Handle "Edit Data" form submission
if (isset($_POST["edit_data"])) {
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $crop_quantity = mysqli_real_escape_string($conn, $_POST["crop_quantity"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);

    $sqlUpdate = "UPDATE agent_data_collection_db 
                  SET crop_id = '$crop_id', 
                      crop_quantity = $crop_quantity, 
                      location = '$location', 
                      expected_price = '$expected_price' 
                  WHERE farmer_id = '$farmer_id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update_data"] = "Data Updated Successfully!";
        header("Location: agent_data_collection_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

die("Invalid request.");
?>
