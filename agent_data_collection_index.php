<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Bid Table</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Bid Table</h1>
            <div>
                <a href="agent_bid_create.php" class="btn btn-primary">Add New Bid</a>
            </div>
        </header>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bid ID</th>
                    <th>Crop ID</th>
                    <th>Farmer ID</th>
                    <th>Minimum Bid Price</th>
                    <th>Current Highest Bid</th>
                    <th>Quantity</th>
                    <th>Location</th>
                    <th>Bid End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connect.php');
                $sqlSelect = "SELECT a.*, COALESCE(MAX(h.final_bid_amount), 0) as highest_bid 
                             FROM agent_bid_create_db a 
                             LEFT JOIN bid_history_db h ON a.bid_id = h.bid_id 
                             GROUP BY a.bid_id";
                $result = mysqli_query($conn, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                    $highest_bid = $data['highest_bid'] > 0 ? $data['highest_bid'] : 'No bids yet';
                ?>
                    <tr>
                        <td><?php echo $data['bid_id']; ?></td>
                        <td><?php echo $data['crop_id']; ?></td>
                        <td><?php echo $data['farmer_id']; ?></td>
                        <td><?php echo $data['min_bid_price']; ?></td>
                        <td><?php echo $highest_bid; ?></td>
                        <td><?php echo $data['quantity']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                        <td><?php echo $data['bid_end_date']; ?></td>
                        <td>
                            <a href="agent_bid_edit.php?id=<?php echo $data['bid_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="agent_bid_delete.php?id=<?php echo $data['bid_id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
