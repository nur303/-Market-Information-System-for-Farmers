<?php
include('connect.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle "Create Data" form submission
if (isset($_POST["create_data"])) {
    $data_collection_id = mysqli_real_escape_string($conn, $_POST["data_collection_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);

    $sqlInsert = "INSERT INTO agent_data_collection_db (data_collection_id, crop_id, farmer_id, location, expected_price) 
                  VALUES ('$data_collection_id', '$crop_id', '$farmer_id', '$location', '$expected_price')";

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
    $data_collection_id = mysqli_real_escape_string($conn, $_POST["data_collection_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $expected_price = mysqli_real_escape_string($conn, $_POST["expected_price"]);

    $sqlUpdate = "UPDATE agent_data_collection_db 
                  SET crop_id = '$crop_id', 
                      farmer_id = '$farmer_id', 
                      location = '$location', 
                      expected_price = '$expected_price' 
                  WHERE data_collection_id = '$data_collection_id'";

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
