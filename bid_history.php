<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Bid History</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Bid History</h1>
            <div>
                <a href="buyer_bid_index.php" class="btn btn-primary">Back to Bids</a>
            </div>
        </header>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
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
                include('connect.php');
                $sql = "SELECT b1.*, 
                        CASE 
                            WHEN b1.bid_end_date > CURRENT_DATE THEN 'Active'
                            ELSE 'Completed'
                        END as bid_status
                        FROM (
                            SELECT h.*
                            FROM bid_history_db h
                            INNER JOIN (
                                SELECT bid_id, MAX(final_bid_amount) as max_bid
                                FROM bid_history_db
                                GROUP BY bid_id
                            ) h2 ON h.bid_id = h2.bid_id AND h.final_bid_amount = h2.max_bid
                        ) b1
                        ORDER BY b1.bid_end_date DESC";
                
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $statusClass = $row['bid_status'] == 'Active' ? 'text-success' : 'text-secondary';
                ?>
                    <tr>
                        <td><?php echo $row['bid_id']; ?></td>
                        <td><?php echo $row['crop_id']; ?></td>
                        <td><?php echo $row['farmer_id']; ?></td>
                        <td><?php echo $row['min_bid_price']; ?></td>
                        <td><?php echo $row['final_bid_amount']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['bid_end_date']; ?></td>
                        <td class="<?php echo $statusClass; ?>"><?php echo $row['bid_status']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
