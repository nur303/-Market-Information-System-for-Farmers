<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Sales Directory</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Sales Directory</h1>
            <div class="back-button-container">
                <button onclick="window.location.href='Farmer Dashboard.php'">&#8592;Back</button>
            </div>
        </header>

        <?php
        session_start();
        if (isset($_SESSION["create"])) {
            ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION["create"];
                unset($_SESSION["create"]);
                ?>
            </div>
            <?php
        }
        ?>
        
        <?php
        if (isset($_SESSION["update"])) {
            ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
                ?>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($_SESSION["delete"])) {
            ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
                ?>
            </div>
            <?php
        }
        ?>
        <div>
                <a href="agent_sales_create.php" class="btn btn-primary">Add New Sale</a>
            </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Date of Harvest</th>
                    <th>Date Sold</th>
                    <th>Quantity of Crops</th>
                    <th>Sold Price</th>
                    <th>Total Production Expense</th>
                    <th>Farmer Profit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('Connection.php');
                $sqlSelect = "SELECT * FROM agent_sales_db";
                $result = mysqli_query($connection, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $data['sale_id']; ?></td>
                        <td><?php echo $data['harvest_date']; ?></td>
                        <td><?php echo $data['date_sold']; ?></td>
                        <td><?php echo $data['quantity']; ?></td>
                        <td><?php echo $data['sold_price']; ?></td>
                        <td><?php echo $data['production_expense']; ?></td>
                        <td><?php echo $data['farmer_profit']; ?></td>
                        <td>
                            <a href="agent_sales_edit.php?id=<?php echo $data['sale_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="agent_sales_delete.php?id=<?php echo $data['sale_id']; ?>" class="btn btn-danger">Delete</a>
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
