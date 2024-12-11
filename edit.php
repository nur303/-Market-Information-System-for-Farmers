<?php
    include "connection.php";
    
    $bid_id = $crop_id = $farmer_id = $quantity = "";
    $error = $success = "";

    if($_SERVER["REQUEST_METHOD"] == 'GET'){
        if(!isset($_GET['bid_id'])){
            header("location: index.php");
            exit;
        }
        
        $bid_id = $_GET['bid_id'];
        $stmt = $conn->prepare("SELECT * FROM crud1 WHERE bid_id = ?");
        $stmt->bind_param("i", $bid_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows != 1){
            header("location: index.php");
            exit;
        }
        
        $row = $result->fetch_assoc();
        $crop_id = $row["crop_id"];
        $farmer_id = $row["farmer_id"];
        $quantity = $row["quantity"];
        
        $stmt->close();
    }
    else {
        $bid_id = $_POST["bid_id"];
        $crop_id = $_POST["crop_id"];
        $farmer_id = $_POST["farmer_id"];
        $quantity = $_POST["quantity"];
        
        $stmt = $conn->prepare("UPDATE crud1 SET crop_id=?, farmer_id=?, quantity=? WHERE bid_id=?");
        $stmt->bind_param("ssii", $crop_id, $farmer_id, $quantity, $bid_id);
        
        if($stmt->execute()){
            header("location: index.php");
            exit;
        } else {
            $error = "Error updating record: " . $conn->error;
        }
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD - Edit</title>
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
                        <a class="nav-link" href="create.php">Add New</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="col-lg-6 m-auto">
        <form method="post">
            <br><br>
            <div class="card">
                <div class="card-header bg-warning">
                    <h1 class="text-white text-center">Update Member</h1>
                </div>
                <div class="card-body">
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <input type="hidden" name="bid_id" value="<?php echo htmlspecialchars($bid_id); ?>">
                    
                    <div class="form-group">
                        <label>Crop ID:</label>
                        <input type="text" name="crop_id" value="<?php echo htmlspecialchars($crop_id); ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Farmer ID:</label>
                        <input type="text" name="farmer_id" value="<?php echo htmlspecialchars($farmer_id); ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" class="form-control" required>
                    </div>
                    
                    <button class="btn btn-success" type="submit">Update</button>
                    <a class="btn btn-info" href="index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
