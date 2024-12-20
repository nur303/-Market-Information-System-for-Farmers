<!DOCTYPE html>
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
            height: 100vh; /* Full height for the sidebar */
        }
        .main-content {
            height: 100vh; /* Full height for the main content */
            overflow-y: auto; /* Enable scrolling if content overflows */
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-success text-white sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_analysis_table.php">Market Analysis Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_info_collection.php">Market Info Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="market_graph.php">Graph</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Log Out</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="mt-4">Market Analyst Dashboard</h1>
                <div class="card mt-4">
                    <div class="row g-0">
                        <div class="col-md-4 text-center p-4">
                            <img src="market_analyst.jpg" class="img-fluid rounded-circle" alt="Market Analyst Photo" width="150">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Market Analyst Details</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Employee ID:</strong> 54321</li>
                                    <li class="list-group-item"><strong>Employee Name:</strong> Jane Smith</li>
                                    <li class="list-group-item"><strong>Email:</strong> jane.smith@example.com</li>
                                    <li class="list-group-item"><strong>Date of Joining:</strong> 2018-05-15</li>
                                    <li class="list-group-item"><strong>Age:</strong> 35</li>
                                    <li class="list-group-item"><strong>Gender:</strong> Female</li>
                                    <li class="list-group-item"><strong>Salary:</strong> $60,000</li>
                                    <li class="list-group-item"><strong>Working Days:</strong> 260</li>
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