<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agricultural Land Yield</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #ffffff;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        img {
            width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Agricultural Land Yield Data</h1>
    <table>
        <caption>Yield of Agricultural Lands (2024)</caption>
        <thead>
            <tr>
                <th>Land ID</th>
                <th>Crop</th>
                <th>Area (hectares)</th>
                <th>Yield (tons)</th>
                <th>Yield per Hectare (tons/hectare)</th>
                <th>Crop Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Corn</td>
                <td>50</td>
                <td>200</td>
                <td>4</td>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/Corn.jpg" class="Corn"
                            style="width: 80px; height: 80px;" alt="" alt="">
                    </div>
                </th>
            </tr>
            <tr>
                <td>002</td>
                <td>Barley</td>
                <td>75</td>
                <td>375</td>
                <td>5</td>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/Barley.jpg" class="Barley"
                            style="width: 80px; height: 80px;" alt="" alt="">
                    </div>
                </th>
            </tr>
            <tr>
                <td>003</td>
                <td>Apple</td>
                <td>100</td>
                <td>450</td>
                <td>4.5</td>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/Apple.jpg" class="Apple"
                            style="width: 80px; height: 80px;" alt="" alt="">
                    </div>
                </th>
            </tr>
            <tr>
                <td>004</td>
                <td>Soybeans</td>
                <td>60</td>
                <td>300</td>
                <td>5</td>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/soybeans.jpg" class="soybeans"
                            style="width: 80px; height: 80px;" alt="" alt="">
                    </div>
                     <a>
                    <a href="chackout.php" class="me-4 my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </th>
            </tr>
        </tbody>
    </table>
</body>
</php>
