<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmerconnect";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM farmer_crop WHERE Crop_Id = $delete_id";
    $connection->query($delete_sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $connection->real_escape_string($_GET['search']);
    $sql = "SELECT Crop_Id, Crop_Name, Season, Description, Crop_Image 
            FROM farmer_crop 
            WHERE Crop_Name LIKE '%$search_query%' OR Season LIKE '%$search_query%'";
} else {
    // Default query to fetch all data
    $sql = "SELECT Crop_Id, Crop_Name, Season, Description, Crop_Image FROM farmer_crop";
}

$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Crop Information</title>
    <link rel="stylesheet" href="Farmer Crop.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4A47A3;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .actions a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 10px;
            border-radius: 4px;
            height: 20px;

        }

        .actions a:hover {
            background-color: #45a049;
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            margin-left: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .crop-image {
            width: 100px;
            height: auto;
        }

        .action-buttons button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .action-buttons .edit {
            background-color: #2196F3;
            color: white;
        }

        .action-buttons .delete {
            background-color: #f44336;
            color: white;
        }

        .action-buttons .edit:hover {
            background-color: #1976D2;
        }

        .action-buttons .delete:hover {
            background-color: #D32F2F;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-button-container">
            <button class="back-btn" onclick="window.location.href='Farmer Dashboard.php'">&#8592; Back</button>
        </div>
        <h1>Farmer Crop Information</h1>

        <div class="actions">
            <a href="add-crop.php">Add Crop</a>
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by Crop Name or Season" value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Crop ID</th>
                    <th>Crop Name</th>
                    <th>Season</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Crop_Id']); ?></td>
                    <td><?php echo htmlspecialchars($row['Crop_Name']); ?></td>
                    <td><?php echo htmlspecialchars($row['Season']); ?></td>
                    <td><?php echo htmlspecialchars($row['Description']); ?></td>
                    <td>
                        <?php if (!empty($row['Crop_Image'])): ?>
                            <img src="<?php echo htmlspecialchars($row['Crop_Image']); ?>" alt="Crop Image" class="crop-image">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td class="action-buttons">
                        <button class="edit" onclick="window.location.href='edit-crop.php?Crop_Id=<?php echo $row['Crop_Id']; ?>'">Edit</button>
                        <button class="delete" onclick="if(confirm('Are you sure you want to delete this crop?')) window.location.href='?delete_id=<?php echo $row['Crop_Id']; ?>'">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No crops found matching your search criteria.</p>
        <?php endif; ?>

        <?php $connection->close(); ?>
    </div>
</body>
</html>
