<?php
if (isset($_GET['id'])) {
    include("Connection.php");
    $id = $_GET['id'];

    $sql = "DELETE FROM agent_sales_db WHERE sale_id='$id'";

    if (mysqli_query($connection, $sql)) {
        session_start();
        $_SESSION["delete"] = "Sale Record Deleted Successfully!";
        header("Location: agent_sales_index.php");
        exit();
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
} else {
    echo "Sale record does not exist.";
}
?>
