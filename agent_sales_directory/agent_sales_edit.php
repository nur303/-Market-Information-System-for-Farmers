<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Edit Sale Record</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Sale Record</h1>
            <div>
                <a href="agent_sales_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="agent_sales_process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM agent_sales_db WHERE sale_id='$id'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="form-element my-4">
                    <label for="sale_id" class="form-label">Sale ID</label>
                    <input type="text" class="form-control" name="sale_id" value="<?php echo $row['sale_id']; ?>" readonly>
                </div>

                <div class="form-element my-4">
                    <label for="harvest_date" class="form-label">Date of Harvest</label>
                    <input type="date" class="form-control" name="harvest_date" value="<?php echo $row['harvest_date']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="date_sold" class="form-label">Date Sold</label>
                    <input type="date" class="form-control" name="date_sold" value="<?php echo $row['date_sold']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="quantity" class="form-label">Quantity of Crops</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="sold_price" class="form-label">Sold Price</label>
                    <input type="number" step="0.01" class="form-control" name="sold_price" value="<?php echo $row['sold_price']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="production_expense" class="form-label">Total Production Expense</label>
                    <input type="number" step="0.01" class="form-control" name="production_expense" value="<?php echo $row['production_expense']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="farmer_profit" class="form-label">Farmer Profit</label>
                    <input type="number" step="0.01" class="form-control" name="farmer_profit" value="<?php echo $row['farmer_profit']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="submit" name="edit_sale" value="Update Sale Record" class="btn btn-primary">
                </div>
            <?php
                } else {
                    echo "<h3>Sale Record does not exist.</h3>";
                }
            } else {
                echo "<h3>Invalid Request</h3>";
            }
            ?>
        </form>
    </div>
</body>
</html>
