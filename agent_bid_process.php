<?php
include('connect.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle "Create Bid" form submission
if (isset($_POST["create_bid"])) {
    // Sanitize and retrieve form inputs
    $bid_id = mysqli_real_escape_string($conn, $_POST["bid_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $min_bid_price = mysqli_real_escape_string($conn, $_POST["min_bid_price"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $bid_end_date = mysqli_real_escape_string($conn, $_POST["bid_end_date"]);

    // Prepare the SQL insert query
    $sqlInsert = "INSERT INTO agent_bid_create_db (bid_id, crop_id, farmer_id, min_bid_price, quantity, location, bid_end_date) 
                  VALUES ('$bid_id', '$crop_id', '$farmer_id', $min_bid_price, $quantity, '$location', '$bid_end_date')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["create_bid"] = "Bid Added Successfully!";
        header("Location:agent_bid_index.php"); // Redirect back to the index page
        exit(); // Ensure no further code is executed
    } else {
        // Display the SQL error
        die("Query failed: " . mysqli_error($conn));
    }
}

// Handle "Edit Bid" form submission
if (isset($_POST["edit_bid"])) {
    // Sanitize and retrieve form inputs
    $bid_id = mysqli_real_escape_string($conn, $_POST["bid_id"]);
    $crop_id = mysqli_real_escape_string($conn, $_POST["crop_id"]);
    $farmer_id = mysqli_real_escape_string($conn, $_POST["farmer_id"]);
    $min_bid_price = mysqli_real_escape_string($conn, $_POST["min_bid_price"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $bid_end_date = mysqli_real_escape_string($conn, $_POST["bid_end_date"]);

    // Prepare the SQL update query
    $sqlUpdate = "UPDATE agent_bid_create_db 
                  SET crop_id = '$crop_id', 
                      farmer_id = '$farmer_id', 
                      min_bid_price = '$min_bid_price', 
                      quantity = $quantity, 
                      location = '$location', 
                      bid_end_date = '$bid_end_date' 
                  WHERE bid_id = '$bid_id'";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "Bid Updated Successfully!";
        header("Location: agent_bid_index.php"); // Redirect back to the index page
        exit(); // Ensure no further code is executed
    } else {
        // Display the SQL error
        die("Query failed: " . mysqli_error($conn));
    }
}

// If no valid form submission is detected, display an error
die("Invalid request.");
?>
