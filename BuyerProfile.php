<!DOCTYPE php>
<php lang="en">
<head>
    <body>
        <div class="container">
            <header>
                <div class="back-button-container">
                    <button class="back-button" onclick="history.back()">&#8592; Back</button>
                </div>
    </body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;      
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        h2 {
            color: #007BFF;
        }
        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-details li {
            margin: 8px 0;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .profile-details li:last-child {
            border-bottom: none;
        }
        strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div>
        <h1>BUYER</h1>
        <div class="container">
            <div class="profile-section">
                <h2>Buyer Profile</h2>
                <div class="profile-picture">
                    <th scope="row">
                        <div class="d-flex align-items-center">
                            <img src="img/buyer.jpg" class="buyer"
                                style="width: 80px; height: 80px;" alt="" alt="">
                        </div>
                    </th>
                </tr>
                </div>
                <ul class="profile-details">
                    <li><strong>buyerID:</strong> 2021741</li>
                    <li><strong>Name:</strong> Md Read Hossain</li>
                    <li><strong>Number:</strong> 01940753524</li>
                    <li><strong>Date of joining:</strong> 2024-01-01</li>
                    <li><strong>Age:</strong> 26</li>
                    <li><strong>Salary:</strong> 20000</li>
                    <li><strong>buyertype:</strong> HR</li>
                    <li><strong>Email:</strong> akberhossainriyaz.rh@gmail.com</li>
                    <li><strong>Address:</strong> Baridhara, Dhaka</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</php>
