<?php
if (isset($_GET['id'])) {
    include("connect.php");
    $id = $_GET['id'];

    $sql = "DELETE FROM agent_data_collection_db WHERE farmer_id='$id'";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete_data"] = "Data Deleted Successfully!";
        header("Location: agent_data_collection_index.php");
        exit();
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
} else {
    echo "Data does not exist.";
}
?>
