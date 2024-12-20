<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Data Collection</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Data Collection</h1>
            <div>
                <a href="agent_data_collection_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="agent_data_collection_process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM agent_data_collection_db WHERE data_collection_id='$id'";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="form-element my-4">
                    <label for="data_collection_id" class="form-label">Data Collection ID</label>
                    <input type="text" class="form-control" name="data_collection_id" id="data_collection_id" value="<?php echo $row['data_collection_id']; ?>" readonly>
                </div>

                <div class="form-element my-4">
                    <label for="crop_id" class="form-label">Crop ID</label>
                    <input type="text" class="form-control" name="crop_id" id="crop_id" value="<?php echo $row['crop_id']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="farmer_id" class="form-label">Farmer ID</label>
                    <input type="text" class="form-control" name="farmer_id" id="farmer_id" value="<?php echo $row['farmer_id']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" id="location" value="<?php echo $row['location']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="expected_price" class="form-label">Expected Price</label>
                    <input type="text" class="form-control" name="expected_price" id="expected_price" value="<?php echo $row['expected_price']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="hidden" name="data_collection_id" value="<?php echo $row['data_collection_id']; ?>">
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
