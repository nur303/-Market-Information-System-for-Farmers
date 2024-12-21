<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Buyers Directory</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Buyers Directory</h1>
            <div>
                <a href="agent_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </header>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connect.php');
                
                // Add error handling for database connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Enable error reporting for debugging
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try {
                    $sqlSelect = "SELECT * FROM buyer_directory";
                    $result = mysqli_query($conn, $sqlSelect);

                    // Check if there are any records
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['name']); ?></td>
                                <td><?php echo htmlspecialchars($data['email']); ?></td>
                                <td><?php echo htmlspecialchars($data['phone']); ?></td>
                                <td><?php echo htmlspecialchars($data['description']); ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4" class="text-center">No buyers found in the directory.</td>
                        </tr>
                        <?php
                    }
                } catch (mysqli_sql_exception $e) {
                    // Log the error (in a production environment)
                    error_log($e->getMessage());
                    // Display user-friendly error message
                    echo '<tr><td colspan="4" class="text-center text-danger">Error: Unable to fetch buyer directory data. Please try again later.</td></tr>';
                }
                
                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
