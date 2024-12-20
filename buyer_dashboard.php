<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
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
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-success text-white sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="buyer_bid_index.php">Crops For Bidding</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="bid_history.php">Bid_History</a>
                    </li>

                    <li class="nav-item mt-auto">
                        <a class="nav-link text-white" href="index.php">Sign Out</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h1 class="mt-4 mb-4">Buyer Dashboard</h1>
                <div class="card employee-card">
                    <div class="row g-0 p-4">
                        <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-center">
                            <img src="buyer_himel.jpg" class="profile-image rounded-circle mb-3" alt="Buyer Photo">
                            <h4 class="mb-0">Himel</h4>
                            <p class="text-muted">Buyer</p>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Buyer Details</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Buyer ID:</strong>
                                        <span>B001</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Email:</strong>
                                        <span>himel@example.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Company:</strong>
                                        <span>ABC Trading Co.</span>
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

