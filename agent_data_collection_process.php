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

    // Prepare the SQL insert query for agent_bid_create_db
    $sqlInsert = "INSERT INTO agent_bid_create_db (bid_id, crop_id, farmer_id, min_bid_price, quantity, location, bid_end_date) 
                  VALUES ('$bid_id', '$crop_id', '$farmer_id', $min_bid_price, $quantity, '$location', '$bid_end_date')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sqlInsert)) {
        // Also insert initial record in bid_history_db with final_bid_amount as 0
        $sqlHistoryInsert = "INSERT INTO bid_history_db (bid_id, crop_id, farmer_id, min_bid_price, final_bid_amount, quantity, location, bid_end_date) 
                            VALUES ('$bid_id', '$crop_id', '$farmer_id', $min_bid_price, 0, $quantity, '$location', '$bid_end_date')";
        
        mysqli_query($conn, $sqlHistoryInsert);
        
        session_start();
        $_SESSION["create_bid"] = "Bid Added Successfully!";
        header("Location:agent_bid_index.php");
        exit();
    } else {
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

    // Update agent_bid_create_db
    $sqlUpdate = "UPDATE agent_bid_create_db 
                  SET crop_id = '$crop_id', 
                      farmer_id = '$farmer_id', 
                      min_bid_price = '$min_bid_price', 
                      quantity = $quantity, 
                      location = '$location', 
                      bid_end_date = '$bid_end_date' 
                  WHERE bid_id = '$bid_id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        // Update the initial record in bid_history_db
        $sqlHistoryUpdate = "UPDATE bid_history_db 
                            SET crop_id = '$crop_id',
                                farmer_id = '$farmer_id',
                                min_bid_price = '$min_bid_price',
                                quantity = $quantity,
                                location = '$location',
                                bid_end_date = '$bid_end_date'
                            WHERE bid_id = '$bid_id' AND final_bid_amount = 0";
        
        mysqli_query($conn, $sqlHistoryUpdate);
        
        session_start();
        $_SESSION["update"] = "Bid Updated Successfully!";
        header("Location: agent_bid_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

// If no valid form submission is detected
die("Invalid request.");
?>
