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
        if (isset($_GET['id'])) {
            include("connect.php");
            $id = $_GET['id'];
            $sql = "SELECT a.*, COALESCE(MAX(b.bid_amount), 0) as highest_bid 
                    FROM agent_bid_create_db a 
                    LEFT JOIN buyer_bid_db b ON a.bid_id = b.bid_id 
                    WHERE a.bid_id='$id'
                    GROUP BY a.bid_id";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_array($result)) {
                $highest_bid = $row['highest_bid'] > 0 ? $row['highest_bid'] : $row['min_bid_price'];
        ?>
            <div class="bid-details mb-4">
                <h3>Bid Details</h3>
                <p><strong>Crop ID:</strong> <?php echo $row['crop_id']; ?></p>
                <p><strong>Minimum Bid Price:</strong> <?php echo $row['min_bid_price']; ?></p>
                <p><strong>Current Highest Bid:</strong> <?php echo $highest_bid; ?></p>
                <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                <p><strong>Bid End Date:</strong> <?php echo $row['bid_end_date']; ?></p>
            </div>

            <form action="buyer_bid_process.php" method="post">
                <div class="form-element my-4">
                    <label for="bid_amount" class="form-label">Your Bid Amount</label>
                    <input type="number" class="form-control" name="bid_amount" 
                           min="<?php echo $highest_bid + 1; ?>" required>
                    <small class="text-muted">Bid must be higher than current highest bid</small>
                </div>

                <div class="form-element my-4">
                    <input type="hidden" name="bid_id" value="<?php echo $row['bid_id']; ?>">
                    <input type="submit" name="place_bid" value="Place Bid" class="btn btn-primary">
                </div>
            </form>
        <?php
            } else {
                echo "<h3>Bid does not exist.</h3>";
            }
        } else {
            echo "<h3>Invalid Request</h3>";
        }
        ?>
    </div>
</body>
</html>
