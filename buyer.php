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
    <title>Buyer Information</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Buyer Information</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Buyer ID</td>
            <td><input type="text" id="buyerID"></td>
        </tr>
        <tr>
            <td>Shop Number</td>
            <td><input type="text" id="shopNumber"></td>
        </tr>
        <tr>
            <td>Preferred Crops</td>
            <td><input type="text" id="preferredCrops"></td>
        </tr>
        <tr>
            <td>Date of Registration</td>
            <td><input type="date" id="dateOfRegistration"></td>
        </tr>
    </table>

    <button onclick="saveBuyer()">Save Buyer</button>

    <script>
        function saveBuyer() {
            // Get values from input fields
            const buyerID = document.getElementById("buyerID").value;
            const shopNumber = document.getElementById("shopNumber").value;
            const preferredCrops = document.getElementById("preferredCrops").value;
            const dateOfRegistration = document.getElementById("dateOfRegistration").value;

            // Send data to server (e.g., using AJAX)
            // ...

            alert("Buyer information saved successfully!");
        }
    </script>

</body>
</php>