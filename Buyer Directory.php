<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmerConnect"; // Your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch all buyers from the database
$sql = "SELECT buyer_id, buyer_name, email, phone_number, description, upload_image FROM buyer_directory";
$result = $connection->query($sql);

$buyers = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $buyers[] = $row;
    }
}

// Close the connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Buyer Directory.css">
    <title>Buyer Directory</title>
</head>
<body>
    <div class="container">
        <header>
            <button onclick="window.location.href='Farmer Dashboard.php'">&#8592;Back</button>
            <h1>Buyer Directory</h1>
            <div class="search-container">
                <input type="text" placeholder="Search Buyer..." class="search-bar" id="search-bar" oninput="searchBuyers()">
                <button class="search-button">Search</button>
            </div>
        </header>

        <div>
            <button class="add-buyer-button" onclick="window.location.href='buyer-registation.php'">Add Buyer</button>
        </div>

        <div class="buyer-list" id="buyer-list">
            <?php
            if (count($buyers) === 0) {
                echo '<p class="no-buyers-message">No buyers found. Please add a buyer.</p>';
            } else {
                foreach ($buyers as $buyer) {
                    $image = htmlspecialchars($buyer['upload_image']) ?: 'placeholder.png';
                    echo '<div class="buyer-card" data-id="' . $buyer['buyer_id'] . '" data-name="' . htmlspecialchars($buyer['buyer_name']) . '" data-email="' . htmlspecialchars($buyer['email']) . '" data-phone="' . htmlspecialchars($buyer['phone_number']) . '" data-description="' . htmlspecialchars($buyer['description']) . '" onclick="showBuyerDetails(this)">
                            <img src="' . $image . '" alt="Buyer Photo" class="buyer-photo">
                            <p class="buyer-name">' . htmlspecialchars($buyer['buyer_name']) . '</p>
                            <p class="buyer-id">ID: ' . $buyer['buyer_id'] . '</p>
                            <div class="buyer-actions">
                                <button class="edit-button" onclick="editBuyer(' . $buyer['buyer_id'] . '); event.stopPropagation();">Edit</button>
                                <button class="delete-button" onclick="deleteBuyer(' . $buyer['buyer_id'] . '); event.stopPropagation();">Delete</button>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>

        <!-- Sidebar to display buyer details -->
        <div class="buyer-details-sidebar" id="buyer-details-sidebar">
            <button class="close-button" onclick="hideBuyerDetails()">X</button>
            <h2>Buyer Details</h2>
            <p><strong>Name:</strong> <span id="buyer-name"></span></p>
            <p><strong>Email:</strong> <span id="buyer-email"></span></p>
            <p><strong>Phone Number:</strong> <span id="buyer-phone"></span></p>
            <p><strong>Description:</strong> <span id="buyer-description"></span></p>
        </div>
    </div>

    <script>
        // Function to show buyer details in the sidebar
        function showBuyerDetails(buyerElement) {
            const buyerName = buyerElement.getAttribute('data-name');
            const buyerEmail = buyerElement.getAttribute('data-email');
            const buyerPhone = buyerElement.getAttribute('data-phone');
            const buyerDescription = buyerElement.getAttribute('data-description');

            // Populate the sidebar content
            document.getElementById('buyer-name').innerText = buyerName;
            document.getElementById('buyer-email').innerText = buyerEmail;
            document.getElementById('buyer-phone').innerText = buyerPhone;
            document.getElementById('buyer-description').innerText = buyerDescription;

            // Show the sidebar
            document.getElementById('buyer-details-sidebar').style.display = 'block';
        }

        // Function to hide the buyer details sidebar
        function hideBuyerDetails() {
            document.getElementById('buyer-details-sidebar').style.display = 'none';
        }

        // Edit buyer functionality
        function editBuyer(buyerId) {
            window.location.href = `BuyerEdit.php?id=${buyerId}`;
        }

        // Delete buyer functionality
        function deleteBuyer(buyerId) {
            if (confirm("Are you sure you want to delete this buyer?")) {
                fetch('delete_buyer.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: buyerId }) // Sending the buyer ID as JSON
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message);
                        location.reload(); // Reload the page after deletion
                    } else {
                        alert(result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }

        // Search functionality
        function searchBuyers() {
            const searchInput = document.getElementById('search-bar').value.toLowerCase();
            const buyerList = document.getElementById('buyer-list');
            const buyers = buyerList.getElementsByClassName('buyer-card');

            let found = false;

            for (let i = 0; i < buyers.length; i++) {
                const buyerName = buyers[i].getAttribute('data-name').toLowerCase();
                if (buyerName.includes(searchInput)) {
                    buyers[i].style.display = '';
                    found = true;
                } else {
                    buyers[i].style.display = 'none';
                }
            }

            // Show or hide "No buyers match your search" message
            const noBuyersMessage = document.querySelector('.no-buyers-message');
            if (!found) {
                if (!noBuyersMessage) {
                    const message = document.createElement('p');
                    message.className = 'no-buyers-message';
                    message.textContent = 'No buyers match your search.';
                    buyerList.appendChild(message);
                }
            } else {
                if (noBuyersMessage) {
                    noBuyersMessage.remove();
                }
            }
        }
    </script>
</body>
</html>
