<?php
session_start();
include('connect.php');

if (isset($_POST['place_bid'])) {
    $bid_id = mysqli_real_escape_string($conn, $_POST['bid_id']);
    $crop_id = mysqli_real_escape_string($conn, $_POST['crop_id']);
    $farmer_id = mysqli_real_escape_string($conn, $_POST['farmer_id']);
    $min_bid_price = floatval($_POST['min_bid_price']);
    $final_bid_amount = floatval($_POST['final_bid_amount']);
    $quantity = intval($_POST['quantity']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $bid_end_date = mysqli_real_escape_string($conn, $_POST['bid_end_date']);

    // Check if bid end date has passed
    $current_date = date('Y-m-d');
    if ($bid_end_date < $current_date) {
        $_SESSION["bid_error"] = "This bid has expired.";
        header("Location: buyer_bid_view.php?id=" . $bid_id);
        exit();
    }

    // Check current highest bid
    $check_sql = "SELECT COALESCE(MAX(final_bid_amount), 0) as highest_bid 
                  FROM bid_history_db 
                  WHERE bid_id = '$bid_id'";
    
    $check_result = mysqli_query($conn, $check_sql);
    $check_row = mysqli_fetch_array($check_result);
    $current_highest = $check_row['highest_bid'];

    if ($current_highest == 0) {
        $current_highest = $min_bid_price;
    }

    // Validate bid amount
    if ($final_bid_amount <= $current_highest) {
        $_SESSION["bid_error"] = "Your bid must be higher than the current highest bid of " . $current_highest;
        header("Location: buyer_bid_view.php?id=" . $bid_id);
        exit();
    }

    // Insert the new bid
    $sql = "INSERT INTO bid_history_db (bid_id, crop_id, farmer_id, min_bid_price, final_bid_amount, quantity, location, bid_end_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssddisd", 
        $bid_id, 
        $crop_id, 
        $farmer_id, 
        $min_bid_price, 
        $final_bid_amount, 
        $quantity, 
        $location, 
        $bid_end_date
    );

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["bid_placed"] = "Your bid has been placed successfully!";
        header("Location: buyer_bid_index.php");
        exit();
    } else {
        $_SESSION["bid_error"] = "Error placing bid: " . mysqli_error($conn);
        header("Location: buyer_bid_view.php?id=" . $bid_id);
        exit();
    }
} else {
    header("Location: buyer_bid_index.php");
    exit();
}
?>
