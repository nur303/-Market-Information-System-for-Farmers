<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Buyer Directory.css">
    <title>Buyer Directory</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="back-button-container">
                <button class="back-button" onclick="history.back()">&#8592; Back</button>
            </div>
            <h1>Buyer Directory</h1>
            <div class="search-container">
                <input type="text" placeholder="Search Buyer..." class="search-bar" id="search-bar" oninput="searchBuyers()">
                <button class="search-button">Search</button>
            </div>
        </header>

        <div>
            <div>
                <div><button class="add-buyer-button" onclick="window.location.href='Buyer Registation.php'">Add Buyer</button></div>
            </div>
        </div>

        <div class="buyer-list" id="buyer-list">
            <!-- Example buyer item -->
            <div class="buyer-card" data-name="MD READ HOSSAIN">
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/buyer.jpg" class="buyer"
                            style="width: 200px; height: 200px;" alt="" alt="">
                    </div>
                </th>
            </tr>
                <p>MD READ HOSSAIN</p>
                <button class="edit-button" onclick="window.location.href='Buyer Edit.php'">Edit</button>
                <button class="delete-button" onclick="deleteBuyer(this)">Delete</button>
            </div>

            <div class="buyer-card" data-name="read">
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <img src="img/some.jpg" class="some"
                            style="width: 200px; height: 200px;" alt="" alt="">
                    </div>
                </th>
            </tr>
                <p>read</p>
                <button class="edit-button" onclick="window.location.href='Buyer Edit.php'">Edit</button>
                <button class="delete-button" onclick="deleteBuyer(this)">Delete</button>
            </div>
        </div>

        <div class="buyer-details-panel" id="buyer-details-panel" style="display:none;">
            <button class="back-button" onclick="hideBuyerDetails()">Back</button>
            <h2>Buyer Details</h2>
            <p><strong>Name:</strong> <span id="buyer-name"></span></p>
            <p><strong>Email:</strong> <span id="buyer-email"></span></p>
            <p><strong>Phone Number:</strong> <span id="buyer-phone"></span></p>
            <p><strong>Description:</strong> <span id="buyer-description"></span></p>
        </div>
    </div>

    <script>
        // Function to show buyer details
        function showBuyerDetails(name, email, phone, description) {
            document.getElementById('buyer-name').innerText = name;
            document.getElementById('buyer-email').innerText = email;
            document.getElementById('buyer-phone').innerText = phone;
            document.getElementById('buyer-description').innerText = description;
            document.getElementById('buyer-details-panel').style.display = 'block';
        }

        // Function to hide buyer details
        function hideBuyerDetails() {
            document.getElementById('buyer-details-panel').style.display = 'none';
        }

        // Search buyer functionality
        function searchBuyers() {
            var searchInput = document.getElementById('search-bar').value.toLowerCase();
            var buyerList = document.getElementById('buyer-list');
            var buyers = buyerList.getElementsByClassName('buyer-card');
            
            // Loop through all buyer cards and hide those that don't match the search
            for (var i = 0; i < buyers.length; i++) {
                var buyerName = buyers[i].getAttribute('data-name').toLowerCase();
                if (buyerName.indexOf(searchInput) > -1) {
                    buyers[i].style.display = '';
                } else {
                    buyers[i].style.display = 'none';
                }
            }
        }

        // Delete buyer functionality
        function deleteBuyer(button) {
            var confirmDelete = confirm("Are you sure you want to delete this buyer?");
            if (confirmDelete) {
                var buyerCard = button.closest('.buyer-card');
                buyerCard.remove();
            }
        }
    </script>
</body>
</php>