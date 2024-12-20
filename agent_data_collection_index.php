<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Data Collection Table</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Data Collection Table</h1>
            <div>
                <a href="agent_data_collection_create.php" class="btn btn-primary">Add New Data</a>
            </div>
        </header>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Farmer ID</th>
                    <th>Crop ID</th>
                    <th>Crop Quantity</th>
                    <th>Location</th>
                    <th>Expected Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connect.php');
                $sqlSelect = "SELECT * FROM agent_data_collection_db";
                $result = mysqli_query($conn, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $data['farmer_id']; ?></td>
                        <td><?php echo $data['crop_id']; ?></td>
                        <td><?php echo $data['crop_quantity']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                        <td><?php echo $data['expected_price']; ?></td>
                        <td>
                            <a href="agent_data_collection_edit.php?id=<?php echo $data['farmer_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="agent_data_collection_delete.php?id=<?php echo $data['farmer_id']; ?>" class="btn btn-danger">Delete</a>
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
