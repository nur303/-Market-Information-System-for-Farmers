// Search function to filter crops in the table
const searchInput = document.getElementById("search");
const rows = document.querySelectorAll("#crop-table tbody tr");

searchInput.addEventListener("input", function() {
    const query = searchInput.value.toLowerCase();
    rows.forEach(row => {
        const cells = row.getElementsByTagName("td");
        const cropId = cells[0].textContent.toLowerCase();  // Crop ID search
        const cropName = cells[1].textContent.toLowerCase(); // Crop Name search
        if (cropId.includes(query) || cropName.includes(query)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

// Crop details and slide-in functionality
const cropDetails = document.getElementById("crop-details");
const closeBtn = document.getElementById("close-btn");
const backBtn = document.getElementById("back-btn");

// Example crop data with image URLs
const cropData = {
    "001": {
        "name": "Wheat",
        "image": "img/wheat.jpg", 
        "details": [
            "Season: Rabi Crop",
            "Grown primarily in northern India",
            "Requires moderate rainfall",
            "Grows in well-drained soil"
        ]
    },
    "002": {
        "name": "Rice",
        "image": "img/rice.jpg", 
        "details": [
            "Season: Kharif Crop",
            "Grown in regions with high rainfall",
            "Requires a lot of water",
            "Requires warm climate"
        ]
    },
    "003": {
        "name": "Cotton",
        "image": "img/cotton.jpg", 
        "details": [
            "Season: Kharif Crop",
            "Needs warm temperatures",
            "Requires plenty of sunlight",
            "Grows in tropical and subtropical climates"
        ]
    },
    "004": {
        "name": "Maize",
        "image": "img/maize.jpg", 
        "details": [
            "Season: Kharif Crop",
            "Requires well-drained soil",
            "Grows in moderate rainfall areas",
            "Grows best in warm climates"
        ]
    },
    "005": {
        "name": "Barley",
        "image": "img/barley.jpg", 
        "details": [
            "Season: Rabi Crop",
            "Grown primarily in cooler regions",
            "Requires moderate rainfall",
            "Grows best in well-drained soil"
        ]
    },
    "006": {
        "name": "Groundnut",
        "image": "img/groundnut.jpg", 
        "details": [
            "Season: Kharif Crop",
            "Requires warm climate",
            "Needs well-drained soil",
            "Requires moderate rainfall"
        ]
    },
    "007": {
        "name": "Sugarcane",
        "image": "img/sugarcane.jpg", 
        "details": [
            "Season: Perennial Crop",
            "Thrives in tropical and subtropical climates",
            "Requires high water availability",
            "Requires full sunlight"
        ]
    },
    "008": {
        "name": "Mustard",
        "image": "img/mustard.jpg", 
        "details": [
            "Season: Rabi Crop",
            "Grown in temperate climates",
            "Requires moderate rainfall",
            "Grows best in cooler climates"
        ]
    },
    "009": {
        "name": "Soybean",
        "image": "img/soybean.jpg", 
        "details": [
            "Season: Kharif Crop",
            "Grows in moderate rainfall areas",
            "Requires well-drained soil",
            "Grows best in warm climates"
        ]
    },
    "010": {
        "name": "Oats",
        "image": "img/oats.jpg", 
        "details": [
            "Season: Rabi Crop",
            "Grown primarily in cooler climates",
            "Requires well-drained soil",
            "Requires moderate rainfall"
        ]
    }
};

// Show crop details and image in list format when clicked on Crop Name or Crop ID
document.querySelectorAll(".crop-id, .crop-name").forEach(item => {
    item.addEventListener("click", function() {
        const cropId = item.closest("tr").querySelector(".crop-id").textContent;
        const crop = cropData[cropId];

        // Populate crop image
        const cropImage = document.getElementById("crop-image");
        cropImage.src = crop.image; 
        cropImage.alt = crop.name;

        // Populate crop details
        const cropDescription = document.getElementById("crop-description");
        cropDescription.innerHTML = ''; // Clear any previous details

        const cropNameItem = document.createElement("li");
        cropNameItem.textContent = `Crop Name: ${crop.name}`;
        cropDescription.appendChild(cropNameItem);

        crop.details.forEach(detail => {
            const detailItem = document.createElement("li");
            detailItem.textContent = detail;
            cropDescription.appendChild(detailItem);
        });

        // Slide-in the details panel
        cropDetails.style.right = "0";
    });
});

// Close slide-in panel
closeBtn.addEventListener("click", function() {
    cropDetails.style.right = "-400px";
});

// Back button functionality
backBtn.addEventListener("click", function() {
    cropDetails.style.right = "-400px";  // Slide the panel back out
});
