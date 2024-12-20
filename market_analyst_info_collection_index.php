<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Market Analysis Table</title>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Market Analysis Table</h1>
            <div>
                <a href="market_analyst_info_collection_create.php" class="btn btn-primary">Add New Analysis</a>
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
                    <th>Action</th>
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
                        <td><?php echo $data['collection_id']; ?></td>
                        <td><?php echo $data['crop_id']; ?></td>
                        <td><?php echo $data['price_perkg']; ?></td>
                        <td><?php echo $data['month']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                        <td>
                            <a href="market_analyst_info_collection_edit.php?id=<?php echo $data['collection_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="market_analyst_info_collection_delete.php?id=<?php echo $data['collection_id']; ?>" class="btn btn-danger">Delete</a>
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