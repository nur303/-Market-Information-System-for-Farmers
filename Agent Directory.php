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

// Fetch all agents from the database
$sql = "SELECT agent_id, agent_name, email, phone_number, description, upload_image FROM agent_directory";
$result = $connection->query($sql);

$agents = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agents[] = $row;
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
    <link rel="stylesheet" href="Agent Directory.css">
    <title>Agent Directory</title>
</head>
<body>
    <div class="container">
        <header>
                <button onclick="window.location.href='Farmer Dashboard.php'">&#8592;Back</button>
            <h1>Agent Directory</h1>
            <div class="search-container">
                <input type="text" placeholder="Search agent..." class="search-bar" id="search-bar" oninput="searchAgents()">
                <button class="search-button">Search</button>
            </div>
        </header>

        <div>
            <button class="add-agent-button" onclick="window.location.href='agent-registation.php'">Add Agent</button>
        </div>

        <div class="agent-list" id="agent-list">
            <?php
            if (count($agents) === 0) {
                echo '<p class="no-agents-message">No agents found. Please add a agent.</p>';
            } else {
                foreach ($agents as $agent) {
                    $image = htmlspecialchars($agent['upload_image']) ?: 'placeholder.png';
                    echo '<div class="agent-card" data-id="' . $agent['agent_id'] . '" data-name="' . htmlspecialchars($agent['agent_name']) . '" data-email="' . htmlspecialchars($agent['email']) . '" data-phone="' . htmlspecialchars($agent['phone_number']) . '" data-description="' . htmlspecialchars($agent['description']) . '" onclick="showAgentDetails(this)">
                            <img src="' . $image . '" alt="Agent Photo" class="agent-photo">
                            <p class="agent-name">' . htmlspecialchars($agent['agent_name']) . '</p>
                            <p class="agent-id">ID: ' . $agent['agent_id'] . '</p>
                            <div class="agent-actions">
                                <button class="edit-button" onclick="editAgent(' . $agent['agent_id'] . '); event.stopPropagation();">Edit</button>
                                <button class="delete-button" onclick="deleteAgent(' . $agent['agent_id'] . '); event.stopPropagation();">Delete</button>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>

        <!-- Sidebar to display agent details -->
        <div class="agent-details-sidebar" id="agent-details-sidebar">
            <button class="close-button" onclick="hideAgentDetails()">X</button>
            <h2>Agent Details</h2>
            <p><strong>Name:</strong> <span id="agent-name"></span></p>
            <p><strong>Email:</strong> <span id="agent-email"></span></p>
            <p><strong>Phone Number:</strong> <span id="agent-phone"></span></p>
            <p><strong>Description:</strong> <span id="agent-description"></span></p>
        </div>
    </div>

    <script>
        // Function to show agent details in the sidebar
        function showAgentDetails(agentElement) {
            const agentName = agentElement.getAttribute('data-name');
            const agentEmail = agentElement.getAttribute('data-email');
            const agentPhone = agentElement.getAttribute('data-phone');
            const agentDescription = agentElement.getAttribute('data-description');

            // Populate the sidebar content
            document.getElementById('agent-name').innerText = agentName;
            document.getElementById('agent-email').innerText = agentEmail;
            document.getElementById('agent-phone').innerText = agentPhone;
            document.getElementById('agent-description').innerText = agentDescription;

            // Show the sidebar
            document.getElementById('agent-details-sidebar').style.display = 'block';
        }

        // Function to hide the agent details sidebar
        function hideAgentDetails() {
            document.getElementById('agent-details-sidebar').style.display = 'none';
        }

        // Edit agent functionality
        function editAgent(agentId) {
            window.location.href = `AgentEdit.php?id=${agentId}`;
        }

        // Delete agent functionality
        function deleteAgent(agentId) {
            if (confirm("Are you sure you want to delete this agent?")) {
                fetch('delete_agent.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: agentId }) // Sending the agent ID as JSON
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
        function searchAgents() {
            const searchInput = document.getElementById('search-bar').value.toLowerCase();
            const agentList = document.getElementById('agent-list');
            const agents = agentList.getElementsByClassName('agent-card');

            let found = false;

            for (let i = 0; i < agents.length; i++) {
                const agentName = agents[i].getAttribute('data-name').toLowerCase();
                if (agentName.includes(searchInput)) {
                    agents[i].style.display = '';
                    found = true;
                } else {
                    agents[i].style.display = 'none';
                }
            }

            // Show or hide "No Agents match your search" message
            const noAgentsMessage = document.querySelector('.no-agents-message');
            if (!found) {
                if (!noAgentsMessage) {
                    const message = document.createElement('p');
                    message.className = 'no-agents-message';
                    message.textContent = 'No agents match your search.';
                    agentList.appendChild(message);
                }
            } else {
                if (noAgentsMessage) {
                    noAgentsMessage.remove();
                }
            }
        }
    </script>
</body>
</html>