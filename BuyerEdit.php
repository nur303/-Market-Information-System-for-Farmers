<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Buyer Directory.css">
    <title>Edit Buyer Details</title>
</head>
<body>
    <div class="container">
        <header>
            <button class="back-button" onclick="window.location.href='Buyer Directory.php'">Back</button>
            <h1>Edit Buyer Details</h1>
        </header>

        <div class="form-container">
            <!-- Image Preview Section -->
            <div class="image-container">
                <img id="buyer-image" class="buyer-image" style="width: 100px; height: 100px;" src="img/buyer.jpg" alt="Buyer Image">
            </div>

            <!-- Form -->
            <form class="edit-form">
                <label for="buyer-name">Buyer Name:</label>
                <input type="text" id="buyer-name" value="MD READ HOSSAIN" required>

                <label for="email">Email:</label>
                <input type="email" id="email" value="john@example.com" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" value="+1234567890" required>

                <label for="description">Description:</label>
                <textarea id="description" required>Experienced buyer with 5 years of purchasing experience.</textarea>

                <label for="image-upload">Upload New Image (Optional):</label>
                <input type="file" id="image-upload" accept="image/*" onchange="previewImage(event)">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Function to preview the uploaded image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                const img = document.getElementById('buyer-image');
                img.src = reader.result; // Set the image source to the uploaded file
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</php>
