<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Edit Market Analysis</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Market Analysis</h1>
            <div>
                <a href="market_analyst_info_collection_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="market_analyst_info_collection_process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM market_analyst_info_collection WHERE collection_id='$id'";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="form-element my-4">
                    <input type="text" class="form-control" name="collection_id" value="<?php echo $row['collection_id']; ?>" readonly>
                </div>

                <div class="form-element my-4">
                    <input type="text" class="form-control" name="crop_id" value="<?php echo $row['crop_id']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="number" step="0.01" class="form-control" name="price_perkg" value="<?php echo $row['price_perkg']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="text" class="form-control" name="month" value="<?php echo $row['month']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="text" class="form-control" name="location" value="<?php echo $row['location']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="hidden" name="collection_id" value="<?php echo $row['collection_id']; ?>">
                    <input type="submit" name="edit_data" value="Update Data" class="btn btn-primary">
                </div>
            <?php
                } else {
                    echo "<h3>Data does not exist.</h3>";
                }
            } else {
                echo "<h3>Invalid Request</h3>";
            }
            ?>
        </form>
    </div>
</body>
</html>