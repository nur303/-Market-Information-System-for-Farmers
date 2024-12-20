<?php
include('connect.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle "Create Data" form submission
if (isset($_POST["create_data"])) {
    $collection_id = mysqli_real_escape_string($conn, $_POST["collection_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $price_perkg = mysqli_real_escape_string($conn, $_POST["price_perkg"]);
    $month = mysqli_real_escape_string($conn, $_POST["month"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);

    $sqlInsert = "INSERT INTO market_analyst_info_collection (collection_id, crop_id, price_perkg, month, location) 
                  VALUES ('$collection_id', '$crop_id', '$price_perkg', '$month', '$location')";

    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["create_data"] = "Data Added Successfully!";
        header("Location: market_analyst_info_collection_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

// Handle "Edit Data" form submission
if (isset($_POST["edit_data"])) {
    $collection_id = mysqli_real_escape_string($conn, $_POST["collection_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $price_perkg = mysqli_real_escape_string($conn, $_POST["price_perkg"]);
    $month = mysqli_real_escape_string($conn, $_POST["month"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);

    $sqlUpdate = "UPDATE market_analyst_info_collection 
                  SET crop_id = '$crop_id', 
                      price_perkg = '$price_perkg', 
                      month = '$month', 
                      location = '$location' 
                  WHERE collection_id = '$collection_id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update_data"] = "Data Updated Successfully!";
        header("Location: market_analyst_info_collection_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

die("Invalid request.");
?>