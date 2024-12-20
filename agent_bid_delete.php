<?php
if (isset($_GET['id'])) {
    include("connect.php");
    $id = $_GET['id']; // Retrieve the `id` from the URL parameter

    // Update the table name to `agent_bid_create_db`
    $sql = "DELETE FROM agent_bid_create_db WHERE bid_id='$id'";

    // Execute the query and check for success
    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "Bid Deleted Successfully!";
        header("Location: agent_bid_index.php"); // Redirect to the index page
        exit(); // Stop further execution
    } else {
        die("Something went wrong: " . mysqli_error($conn)); // Show detailed error
    }
} else {
    echo "Bid does not exist.";
}
?>
