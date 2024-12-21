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
                <a href="agent_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </header>

        <?php
        include('connect.php');
        
        // Enable error reporting for debugging
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            // Make sure to use the correct table name and columns
            $sqlSelect = "SELECT bh.*, p.property_name 
                         FROM bid_history bh 
                         LEFT JOIN properties p ON bh.property_id = p.property_id 
                         ORDER BY bh.bid_date DESC";
            
            // Debug the query
            // echo $sqlSelect; // Uncomment this line to see the actual query

            $result = mysqli_query($conn, $sqlSelect);

            if (!$result) {
                throw new Exception("Query failed: " . mysqli_error($conn));
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Bid Amount</th>
                        <th>Bid Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['property_name'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['bid_amount'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['bid_date'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['status'] ?? 'N/A'); ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4" class="text-center">No bid history found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Error: ' . htmlspecialchars($e->getMessage());
            echo '</div>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
