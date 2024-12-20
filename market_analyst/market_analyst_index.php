<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Market Analyst</title>
    <style>
        table  td, table th{
        vertical-align:middle;
        text-align:right;
        padding:20px!important;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Market Analyst</h1>
            <div>
                <a href="market_analyst_create.php" class="btn btn-primary">Add New Crop Info</a>
                <a href="buyer.html" class="btn btn-primary">Back</a>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["create"];
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
         <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["update"];
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>
        
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Crop Name</th>
            <th>Crop Id</th>
            <th>Area code</th>
            <th>Area Location</th>
            <th>Reason for Advice Rate</th>
            <th>Expected Price (Tk/kg)</th>
            <th>Highest Price</th>
            <th>Lowest Price</th>
            <th>Current Demand Status</th>
            <th>Current Supply Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include('market_analyst_connect.php');
        $sqlSelect = "SELECT * FROM books";
        $result = mysqli_query($conn, $sqlSelect);
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['crop_name']; ?></td>
                <td><?php echo $data['crop_id']; ?></td>
                <td><?php echo $data['area_code']; ?></td>
                <td><?php echo $data['area_location']; ?></td>
                <td><?php echo $data['advice_reason']; ?></td>
                <td><?php echo $data['expected_price']; ?></td>
                <td><?php echo $data['highest_price']; ?></td>
                <td><?php echo $data['lowest_price']; ?></td>
                <td><?php echo $data['demand_status']; ?></td>
                <td><?php echo $data['supply_status']; ?></td> 
                <td>
                    <a href="market_analyst_edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="market_analyst_delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
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