<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Profile</title>
    <link rel="stylesheet" href="Farmer Profile.css">
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <button class="back-btn" onclick="history.back()">&#8592;Back</button>
        
        <div class="profile-section">
            <h1>Farmer</h1>
            <h2>Your Profile</h2>
            <div class="profile-picture">
                <img src="img/farmer.jpg" alt="Farmer Picture" style="width:100px">
            </div>
            
            <!-- Profile Details Form -->
            <form id="profile-form">
                <ul class="profile-details">
                    <li><strong>Farmer ID:</strong> <span id="farmer-id">F001</span></li>
                    <li><strong>Name:</strong> <span id="farmer-name">Nur Muhammad</span></li>
                    <li><strong>Number:</strong> <span id="farmer-number">01888032618</span> <button type="button" class="edit-btn" onclick="editField('farmer-number', 'tel')">Edit</button></li>
                    <li><strong>Email:</strong> <span id="farmer-email">nurmuhammadsusmoy@gmail.com</span> <button type="button" class="edit-btn" onclick="editField('farmer-email', 'email')">Edit</button></li>
                    <li><strong>Address:</strong> <span id="farmer-address">Fulbaria, Mymensing</span></li>
                </ul>

                <!-- Save Button -->
                <div class="save-button-container" style="display: none;">
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to enable editing of fields (only for editable fields)
        function editField(fieldId, type) {
            const field = document.getElementById(fieldId);
            const value = field.textContent || field.innerText;
            
            // Replace the text with an input field
            const input = document.createElement('input');
            input.type = type || 'text'; // Default to text if no type is specified
            input.value = value;
            input.id = `${fieldId}-input`;  // Unique ID for the input field

            field.innerHTML = '';
            field.appendChild(input);

            // Show the Save button
            document.querySelector('.save-button-container').style.display = 'block';
        }

        // Handle form submission (Save)
        document.getElementById('profile-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get all the fields and their edited values
            const fields = ['farmer-id', 'farmer-name', 'farmer-number', 'farmer-email', 'farmer-address'];
            fields.forEach(fieldId => {
                const inputField = document.getElementById(`${fieldId}-input`);
                if (inputField) {
                    document.getElementById(fieldId).innerText = inputField.value;
                }
            });

            // Hide the Save button after saving
            document.querySelector('.save-button-container').style.display = 'none';
        });
    </script>
</body>
</html>
