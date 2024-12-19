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
                        <a class="nav-link text-white" href="/agent_data_collection/agent_data_collection_index.php">Data Collection</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="/agent_bid_create/agent_bid_index.php">Crops For Bidding</a>
                    </li>

                    

                    <li class="nav-item">
                        <a class="nav-link text-white" href="advised-rates.html">Analysis View</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="agent_graph.php">Graph View</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html">Sign Out</a>
                    </li>

                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="mt-4">Dashboard</h1>
                <div class="card mt-4">
                    <div class="row g-0">
                        <div class="col-md-4 text-center p-4">
                            <img src="market_analyst.jpg" class="img-fluid rounded-circle" alt="Employee Photo" width="150">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Employee Details</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Employee ID:</strong> 12345</li>
                                    <li class="list-group-item"><strong>Employee Name:</strong> John Doe</li>
                                    <li class="list-group-item"><strong>Email:</strong> john.doe@example.com</li>
                                    <li class="list-group-item"><strong>Date of Joining:</strong> 2020-01-01</li>
                                    <li class="list-group-item"><strong>Age:</strong> 30</li>
                                    <li class="list-group-item"><strong>Gender:</strong> Male</li>
                                    <li class="list-group-item"><strong>Salary:</strong> $50,000</li>
                                    <li class="list-group-item"><strong>Working Days:</strong> 250</li>
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