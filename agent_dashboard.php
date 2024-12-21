<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .sidebar {
            height: 100vh;
        }
        .main-content {
            height: 100vh;
            overflow-y: auto;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 4px solid #198754;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .employee-card {
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .list-group-item {
            background-color: transparent;
            border-left: none;
            border-right: none;
            padding: 1rem 1.25rem;
        }
        .card-title {
            color: #198754;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <?php
    include 'connect.php';
    $sql = "SELECT COUNT(*) as total_bids FROM agent_bid_create_db";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_bids = $row['total_bids'];
    mysqli_close($conn);
    ?>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-success text-white sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="agent_data_collection_index.php">Data Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="agent_bid_index.php">Crops For Bidding</a>
                    </li>
        
                    <li class="nav-item">
                        <a class="nav-link text-white" href="agent_market_view.php">Market View</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="agent_graph.php">Graph View</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="bid_history.php">Bid_History</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="bid_history.php">View Buyer Directory</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Sign Out</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="mt-4 mb-4">Dashboard</h1>
                <div class="card employee-card">
                    <div class="row g-0 p-4">
                        <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-center">
                            <img src="agent_pitak.jpg" class="profile-image rounded-circle mb-3" alt="Employee Photo">
                            <h4 class="mb-0">Pitak Chakma</h4>
                            <p class="text-muted">Agent</p>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Employee Details</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Employee ID:</strong>
                                        <span>E001</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Email:</strong>
                                        <span>pitakchakma5@gmail.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Age:</strong>
                                        <span>22</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Total Number of Bids:</strong>
                                        <span class="badge bg-success rounded-pill fs-6"><?php echo $total_bids; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>