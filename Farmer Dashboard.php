<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeDashboard</title>
    <link rel="stylesheet" href="Farmer Dashboard.css">
    <!-- Include Chart.js for graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Left side (Navigation & Profile) -->
        <div class="sidebar">
            <div class="logo">
                <img src="img/logo.jpg" alt="logo" style="width: 200px;">
            </div>
            <nav>
                <ul>
                    <li><a href="Farmer Profile.php">Profile</a></li>
                    <li><a href="Farmer Land.php">Farmer Land</a></li>
                    <li><a href="Farmer Crop.php">Farmer Crop</a></li>
                    <li><a href="agent_sales_index.php">Sales Directory</a></li>
                    <li><a href="Agent Directory.php">Agent Directory</a></li>
                    <li><a href="Buyer Directory.php">Buyer Directory</a></li>
                    <li><a href="index.php" class="logout-btn">Log Out</a></li> <!-- Log Out Button -->
                </ul>
            </nav>
        </div>

        <!-- Right side (Data & Information) -->
        <div class="main-content">
            <header>
                <h1>Welcome to Farmer Dashboard</h1>
                <h2>Monthly Production</h2>
                <canvas id="productChart"></canvas>
            </header>

            <!-- Weather Forecast and Profit Pie Chart -->
            <div class="bottom-section">
                <!-- Weather Information -->
                <div class="weather">
                    <h2>Weather Forecast</h2>
                    <form id="weatherForm">
                        <input type="text" id="locationInput" placeholder="Enter location" required />
                        <button type="submit">Check Weather</button>
                    </form>
                    <div class="weather-details" id="weatherDetails">
                        <!-- Weather details will be injected here by JavaScript -->
                    </div>
                    <img src="img/icon.jpg" alt="weather icon" style="width: 50px;">
                </div>

                <!-- Profit (Pie Chart) -->
                <div class="chart-container">
                    <h2>Profit Distribution</h2>
                    <canvas id="profitChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Product Details Bar Chart
        const ctx1 = document.getElementById('productChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Production',
                    data: [120, 150, 130, 180, 140, 160, 200, 170, 220, 180, 160, 140],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Profit Pie Chart
        const ctx2 = document.getElementById('profitChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Profit Distribution',
                    data: [20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40', '#FFCD56', '#FF6666', '#4B8D3A', '#76C7C0', '#6A4C6C', '#D1C8B8', '#E3B0D8'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            }
        });

        // Fetch Weather Data on Form Submit using $.getJSON()
        $('#weatherForm').on('submit', function(event) {
            event.preventDefault(); // Prevent page refresh
            const location = $('#locationInput').val(); // Get the location input
            const apiKey = 'e532d04c5fff84739ad4b4c10903da5e'; // Your OpenWeatherMap API Key
            const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=${apiKey}&units=metric`;

            // Fetch data from OpenWeatherMap using the $.getJSON() method
            $.getJSON(apiUrl, function(data) {
                // On success, update the weather details
                const weatherDetails = `
                    <p><strong>Temperature:</strong> ${data.main.temp}°C</p>
                    <p><strong>Precipitation:</strong> ${data.weather[0].description}</p>
                    <p><strong>Humidity:</strong> ${data.main.humidity}%</p>
                    <p><strong>Wind Speed:</strong> ${data.wind.speed} km/h</p>
                `;
                $('#weatherDetails').html(weatherDetails); // Inject weather details into the page
            }).fail(function() {
                // If the request fails, show an error message
                $('#weatherDetails').html('<p>Error fetching weather data. Please try again later.</p>');
            });
        });
    </script>
</body>
</html>
