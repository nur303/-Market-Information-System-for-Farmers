<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Market Analysis Information</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Market Analysis Information</h1>
            <div>
                <a href="agent_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </header>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Collection ID</th>
                    <th>Crop ID</th>
                    <th>Price per KG</th>
                    <th>Month</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connect.php');
                
                $sql = "SELECT * FROM market_analyst_info_collection ORDER BY month DESC";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['collection_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['crop_id']); ?></td>
                            <td>₹<?php echo htmlspecialchars(number_format($data['price_perkg'], 2)); ?></td>
                            <td><?php echo htmlspecialchars($data['month']); ?></td>
                            <td><?php echo htmlspecialchars($data['location']); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Basic statistics -->
    <div class="container mb-4">
        <?php
        $statsQuery = "SELECT 
            COUNT(*) as total_records,
            AVG(price_perkg) as avg_price,
            MAX(price_perkg) as max_price,
            MIN(price_perkg) as min_price
        FROM market_analyst_info_collection";
        
        $statsResult = mysqli_query($conn, $statsQuery);
        $stats = mysqli_fetch_assoc($statsResult);
        ?>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Records</h5>
                        <p class="card-text"><?php echo $stats['total_records']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Average Price</h5>
                        <p class="card-text">₹<?php echo number_format($stats['avg_price'], 2); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Highest Price</h5>
                        <p class="card-text">₹<?php echo number_format($stats['max_price'], 2); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Lowest Price</h5>
                        <p class="card-text">₹<?php echo number_format($stats['min_price'], 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>