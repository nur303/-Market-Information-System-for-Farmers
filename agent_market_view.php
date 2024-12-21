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

        <table class="table table-bordered">
            <thead>
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
                $sqlSelect = "SELECT * FROM market_analyst_info_collection";
                $result = mysqli_query($conn, $sqlSelect);
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
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>