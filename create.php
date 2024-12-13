<?php
    include "connection.php";
    
    if(isset($_POST['submit'])){
        // Validate input
        if(!empty($_POST['crop_id']) && !empty($_POST['farmer_id']) && !empty($_POST['quantity']) && !empty($_POST['bid_end_time'])) {
            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO crud1 (crop_id, farmer_id, quantity, bid_end_time) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $_POST['crop_id'], $_POST['farmer_id'], $_POST['quantity'], $_POST['bid_end_time']);
            
            if($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>All fields are required!</div>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Create</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php"><span style="font-size:larger;">Add New</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="col-lg-6 m-auto">
        <form method="post">
            <br><br>
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="text-white text-center">Create New Bid</h1>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Crop ID:</label>
                        <input type="text" name="crop_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Farmer ID:</label>
                        <input type="text" name="farmer_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bid End Time:</label>
                        <input type="datetime-local" name="bid_end_time" class="form-control" required>
                    </div>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                    <a class="btn btn-info" href="index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
