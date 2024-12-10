<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agent Bid Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">farmerConnect</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li> -->
                    <li class="nav-item">
                        <a type="button" class="btn btn-primary nav-link active" href="create.php">Add New</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container my-4">
        <table class="table table-bordered">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Bid ID</th>
                    <th>Crop ID</th>
                    <th>Farmer ID</th>
                    <th>Quantity</th>
                    <th>Bid End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connection.php";
                $sql = "SELECT * FROM crud1";
                $result = $conn->query($sql);
                
                if(!$result){
                    die("Invalid query: " . $conn->error);
                }
                
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                        <td>" . htmlspecialchars($row['bid_id'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($row['crop_id'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($row['farmer_id'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($row['quantity'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($row['bid_end_time'] ?? 'N/A') . "</td>
                        <td>
                            <a class='btn btn-success btn-sm' href='edit.php?bid_id=" . htmlspecialchars($row['bid_id']) . "'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete.php?bid_id=" . htmlspecialchars($row['bid_id']) . "' 
                               onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
