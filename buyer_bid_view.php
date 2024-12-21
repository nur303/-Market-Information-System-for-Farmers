<?php
session_start();
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Place Bid</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Place Your Bid</h1>
            <div>
                <a href="buyer_bid_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <?php
        if (isset($_SESSION["bid_error"])) {
        ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION["bid_error"];
                unset($_SESSION["bid_error"]);
                ?>
            </div>
        <?php
        }

        $id = $_GET['id'];
        $sql = "SELECT a.*, COALESCE(MAX(h.final_bid_amount), 0) as highest_bid 
                FROM agent_bid_create_db a 
                LEFT JOIN bid_history_db h ON a.bid_id = h.bid_id 
                WHERE a.bid_id = '$id'
                GROUP BY a.bid_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $highest_bid = $row['highest_bid'] > 0 ? $row['highest_bid'] : $row['min_bid_price'];
        ?>

        <div class="card p-4">
            <h3>Bid Details</h3>
            <p><strong>Crop ID:</strong> <?php echo $row['crop_id']; ?></p>
            <p><strong>Farmer ID:</strong> <?php echo $row['farmer_id']; ?></p>
            <p><strong>Minimum Bid Price:</strong> <?php echo $row['min_bid_price']; ?></p>
            <p><strong>Current Highest Bid:</strong> <?php echo $highest_bid; ?></p>
            <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Bid End Date:</strong> <?php echo $row['bid_end_date']; ?></p>

            <form action="buyer_bid_process.php" method="post">
                <input type="hidden" name="bid_id" value="<?php echo $row['bid_id']; ?>">
                <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>">
                <input type="hidden" name="farmer_id" value="<?php echo $row['farmer_id']; ?>">
                <input type="hidden" name="min_bid_price" value="<?php echo $row['min_bid_price']; ?>">
                <input type="hidden" name="quantity" value="<?php echo $row['quantity']; ?>">
                <input type="hidden" name="location" value="<?php echo $row['location']; ?>">
                <input type="hidden" name="bid_end_date" value="<?php echo $row['bid_end_date']; ?>">
                
                <div class="form-element my-4">
                    <label class="form-label">Your Bid Amount:</label>
                    <input type="number" class="form-control" name="final_bid_amount" step="0.01" 
                           min="<?php echo $highest_bid + 0.01; ?>" 
                           placeholder="Enter your bid amount (minimum: <?php echo $highest_bid + 0.01; ?>)" 
                           required>
                </div>
                
                <div class="form-element my-4">
                    <input type="submit" name="place_bid" class="btn btn-success" value="Place Bid">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
