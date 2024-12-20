<?php
include('connect.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle bid placement
if (isset($_POST["place_bid"])) {
    // Sanitize and retrieve form inputs
    $bid_id = mysqli_real_escape_string($conn, $_POST["bid_id"]);
    $bid_amount = mysqli_real_escape_string($conn, $_POST["bid_amount"]);

    // First, get the original bid details
    $sqlOriginal = "SELECT * FROM agent_bid_create_db WHERE bid_id='$bid_id'";
    $resultOriginal = mysqli_query($conn, $sqlOriginal);
    $originalBid = mysqli_fetch_array($resultOriginal);

    // Check if bid is still active
    if (strtotime($originalBid['bid_end_date']) < strtotime('today')) {
        die("This bid has expired.");
    }

    // Check if bid amount is higher than minimum bid price
    if ($bid_amount < $originalBid['min_bid_price']) {
        die("Bid amount must be higher than minimum bid price.");
    }

    // Get the current highest bid
    $sqlHighest = "SELECT MAX(bid_amount) as highest_bid FROM buyer_bid_db WHERE bid_id='$bid_id'";
    $resultHighest = mysqli_query($conn, $sqlHighest);
    $highestBid = mysqli_fetch_array($resultHighest);

    if ($highestBid['highest_bid'] && $bid_amount <= $highestBid['highest_bid']) {
        die("Bid amount must be higher than current highest bid.");
    }

    // Insert the new bid into buyer_bid_db
    $sqlInsert = "INSERT INTO buyer_bid_db (bid_id, crop_id, farmer_id, min_bid_price, 
                                          quantity, location, bid_end_date, bid_amount) 
                  VALUES ('$bid_id', 
                          '{$originalBid['crop_id']}', 
                          '{$originalBid['farmer_id']}', 
                          {$originalBid['min_bid_price']}, 
                          {$originalBid['quantity']}, 
                          '{$originalBid['location']}', 
                          '{$originalBid['bid_end_date']}', 
                          $bid_amount)";

    if (mysqli_query($conn, $sqlInsert)) {
        session_start();
        $_SESSION["bid_placed"] = "Bid Placed Successfully!";
        header("Location: buyer_bid_index.php");
        exit();
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

// If no valid form submission is detected
die("Invalid request.");
?>
