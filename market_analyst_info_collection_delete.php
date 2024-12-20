<?php
if (isset($_GET['id'])) {
    include("connect.php");
    $id = $_GET['id'];

    $sql = "DELETE FROM market_analyst_info_collection WHERE collection_id='$id'";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete_data"] = "Data Deleted Successfully!";
        header("Location: market_analyst_info_collection_index.php");
        exit();
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
} else {
    echo "Data does not exist.";
}
?>