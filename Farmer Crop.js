// Search function to filter crops in the table
const searchInput = document.getElementById("search");
const rows = document.querySelectorAll("#crop-table tbody tr");

searchInput.addEventListener("input", function() {
    const query = searchInput.value.toLowerCase();
    rows.forEach(row => {
        const cells = row.getElementsByTagName("td");
        const cropName = cells[1].textContent.toLowerCase();
        if (cropName.includes(query)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

// Crop details and slide-in functionality
const cropDetails = document.getElementById("crop-details");
const closeBtn = document.getElementById("close-btn");

// Example crop data
const cropData = {
    "001": "Wheat is a Rabi crop primarily grown in northern India. It requires moderate rainfall and well-drained soil.",
    "002": "Rice is a Kharif crop and is widely grown in regions with high rainfall, requiring a lot of water.",
    "003": "Cotton is a Kharif crop and needs warm temperatures and plenty of sunlight to grow.",
    "004": "Maize is a Kharif crop, requiring well-drained soil and moderate rainfall.",
    "005": "Barley is a Rabi crop, grown primarily in cooler regions with moderate rainfall.",
    "006": "Groundnut is a Kharif crop, requiring well-drained soil and warm climate for optimal growth.",
    "007": "Sugarcane is a perennial crop, thriving in tropical and subtropical climates with high water availability.",
    "008": "Mustard is a Rabi crop, typically grown in temperate climates requiring moderate rainfall.",
    "009": "Soybean is a Kharif crop requiring moderate rainfall and well-drained soil.",
    "010": "Oats is a Rabi crop, ideal for cooler climates with well-drained soil."
};

// Show crop details when clicked on Crop Name or Crop ID
document.querySelectorAll(".crop-id, .crop-name").forEach(item => {
    item.addEventListener("click", function() {
        const cropId = item.closest("tr").querySelector(".crop-id").textContent;
        const cropName = item.closest("tr").querySelector(".crop-name").textContent;
        const description = cropData[cropId];

        document.getElementById("crop-description").textContent = `Crop Name: ${cropName}\nDetails: ${description}`;
        cropDetails.style.right = "0";
    });
});

// Close slide-in panel
closeBtn.addEventListener("click", function() {
    cropDetails.style.right = "-400px";
});
