<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Final Bid Results</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Final Bid Results</h1>
            <div>
                <a href="buyer_bid_index.php" class="btn btn-primary">Back to Bids</a>
            </div>
        </header>

        <?php
        include('connect.php');
        
        // Get current date for comparison
        $current_date = date('Y-m-d');
        ?>

        <!-- Active Bids Section -->
        <h2 class="my-4">Active Bids</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Bid ID</th>
                    <th>Crop ID</th>
                    <th>Farmer ID</th>
                    <th>Minimum Bid Price</th>
                    <th>Current Highest Bid</th>
                    <th>Quantity</th>
                    <th>Location</th>
                    <th>Bid End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to get the latest bid for each active bid_id
                $sqlActive = "SELECT b1.*, 
                            CASE 
                                WHEN b1.bid_end_date > CURRENT_DATE THEN 'Active'
                                ELSE 'Closed'
                            END as bid_status
                            FROM buyer_bid_db b1
                            INNER JOIN (
                                SELECT bid_id, MAX(bid_amount) as max_bid
                                FROM buyer_bid_db
                                GROUP BY bid_id
                            ) b2 ON b1.bid_id = b2.bid_id AND b1.bid_amount = b2.max_bid
                            WHERE b1.bid_end_date >= CURRENT_DATE
                            ORDER BY b1.bid_id, b1.bid_amount DESC";

                $resultActive = mysqli_query($conn, $sqlActive);
                
                if (mysqli_num_rows($resultActive) > 0) {
                    while ($row = mysqli_fetch_array($resultActive)) {
                ?>
                    <tr>
                        <td><?php echo $row['bid_id']; ?></td>
                        <td><?php echo $row['crop_id']; ?></td>
                        <td><?php echo $row['farmer_id']; ?></td>
                        <td><?php echo number_format($row['min_bid_price'], 2); ?></td>
                        <td class="text-success fw-bold">
                            <?php echo number_format($row['bid_amount'], 2); ?>
                        </td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['bid_end_date']; ?></td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No active bids found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Completed Bids Section -->
        <h2 class="my-4">Completed Bids</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Bid ID</th>
                    <th>Crop ID</th>
                    <th>Farmer ID</th>
                    <th>Minimum Bid Price</th>
                    <th>Final Bid Amount</th>
                    <th>Quantity</th>
                    <th>Location</th>
                    <th>Bid End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to get the final results of completed bids
                $sqlCompleted = "SELECT b1.*, 
                               CASE 
                                   WHEN b1.bid_end_date <= CURRENT_DATE THEN 'Completed'
                                   ELSE 'Active'
                               END as bid_status
                               FROM buyer_bid_db b1
                               INNER JOIN (
                                   SELECT bid_id, MAX(bid_amount) as max_bid
                                   FROM buyer_bid_db
                                   GROUP BY bid_id
                               ) b2 ON b1.bid_id = b2.bid_id AND b1.bid_amount = b2.max_bid
                               WHERE b1.bid_end_date < CURRENT_DATE
                               ORDER BY b1.bid_end_date DESC";

                $resultCompleted = mysqli_query($conn, $sqlCompleted);
                
                if (mysqli_num_rows($resultCompleted) > 0) {
                    while ($row = mysqli_fetch_array($resultCompleted)) {
                ?>
                    <tr>
                        <td><?php echo $row['bid_id']; ?></td>
                        <td><?php echo $row['crop_id']; ?></td>
                        <td><?php echo $row['farmer_id']; ?></td>
                        <td><?php echo number_format($row['min_bid_price'], 2); ?></td>
                        <td class="text-primary fw-bold">
                            <?php echo number_format($row['bid_amount'], 2); ?>
                        </td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['bid_end_date']; ?></td>
                        <td>
                            <span class="badge bg-secondary">Completed</span>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No completed bids found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Bid Statistics -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Active Bids</h5>
                        <?php
                        $sqlActiveCount = "SELECT COUNT(DISTINCT bid_id) as active_count 
                                         FROM buyer_bid_db 
                                         WHERE bid_end_date >= CURRENT_DATE";
                        $resultActiveCount = mysqli_query($conn, $sqlActiveCount);
                        $activeCount = mysqli_fetch_array($resultActiveCount)['active_count'];
                        ?>
                        <p class="card-text h3"><?php echo $activeCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Completed Bids</h5>
                        <?php
                        $sqlCompletedCount = "SELECT COUNT(DISTINCT bid_id) as completed_count 
                                            FROM buyer_bid_db 
                                            WHERE bid_end_date < CURRENT_DATE";
                        $resultCompletedCount = mysqli_query($conn, $sqlCompletedCount);
                        $completedCount = mysqli_fetch_array($resultCompletedCount)['completed_count'];
                        ?>
                        <p class="card-text h3"><?php echo $completedCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Average Bid Amount</h5>
                        <?php
                        $sqlAvgBid = "SELECT AVG(bid_amount) as avg_bid FROM buyer_bid_db";
                        $resultAvgBid = mysqli_query($conn, $sqlAvgBid);
                        $avgBid = mysqli_fetch_array($resultAvgBid)['avg_bid'];
                        ?>
                        <p class="card-text h3"><?php echo number_format($avgBid, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
