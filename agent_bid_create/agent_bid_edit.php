<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Bid</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Bid</h1>
            <div>
                <a href="agent_bid_index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="agent_bid_process.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM agent_bid_create_db WHERE bid_id='$id'";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="form-element my-4">
                    <label for="bid_id" class="form-label">Bid ID</label>
                    <input type="text" class="form-control" name="bid_id" id="bid_id" value="<?php echo $row['bid_id']; ?>" readonly>
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
                    <label for="min_bid_price" class="form-label">Minimum Bid Price</label>
                    <input type="text" class="form-control" name="min_bid_price" id="min_bid_price" value="<?php echo $row['min_bid_price']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $row['quantity']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" id="location" value="<?php echo $row['location']; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="bid_end_date" class="form-label">Bid End Date</label>
                    <input type="date" class="form-control" name="bid_end_date" id="bid_end_date" value="<?php echo $row['bid_end_date']; ?>">
                </div>

                <div class="form-element my-4">
                    <input type="hidden" name="bid_id" value="<?php echo $row['bid_id']; ?>">
                    <input type="submit" name="edit_bid" value="Update Bid" class="btn btn-primary">
                </div>
            <?php
                } else {
                    echo "<h3>Bid does not exist.</h3>";
                }
            } else {
                echo "<h3>Invalid Request</h3>";
            }
            ?>
        </form>
    </div>
</body>
</html>
