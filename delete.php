<?php
    include "connection.php";
    
    if(isset($_GET['bid_id'])){
        $bid_id = $_GET['bid_id'];
        
        // Use prepared statement for delete
        $stmt = $conn->prepare("DELETE FROM crud1 WHERE bid_id = ?");
        $stmt->bind_param("i", $bid_id);
        
        if($stmt->execute()) {
            header('location: index.php');
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $stmt->close();
    } else {
        header('location: index.php');
        exit;
    }
?>
