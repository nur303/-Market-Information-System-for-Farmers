<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Analyst Dashboard</title>
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
    // include 'connect.php';
    // $sql = "SELECT COUNT(*) as total_analysis FROM market_analyst_analysis_db";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    // $total_analysis = $row['total_analysis'];
    // mysqli_close($conn);
    ?>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-success text-white sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_analyst_index.php">Market Analysis Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_analyst_info_collection_index.php">Market Info Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_analyst_graph.php">Graph</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Log Out</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="mt-4 mb-4">Market Analyst Dashboard</h1>
                <div class="card employee-card">
                    <div class="row g-0 p-4">
                        <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-center">
                            <img src="analyst_ronon.jpg" class="profile-image rounded-circle mb-3" alt="Market Analyst Photo">
                            <h4 class="mb-0">Muhit Ronon</h4>
                            <p class="text-muted">Market Analyst</p>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Employee Details</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Employee ID:</strong>
                                        <span>E002</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Email:</strong>
                                        <span>ronon.muhit@gmail.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Age:</strong>
                                        <span>22</span>
                                    <!-- </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Total Number of Analysis:</strong>
                                        <span class="badge bg-success rounded-pill fs-6"><?php echo $total_analysis; ?></span>
                                    </li> -->
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