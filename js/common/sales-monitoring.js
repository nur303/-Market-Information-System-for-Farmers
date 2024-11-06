document.addEventListener('DOMContentLoaded', function() {
    // Check authentication
    const userType = sessionStorage.getItem('userType');
    const userId = sessionStorage.getItem('userId');

    if (!userType || !userId) {
        window.location.href = '../auth/login.html';
        return;
    }

    // Set up back button navigation based on user type
    const backButton = document.getElementById('backToDashboard');
    backButton.href = `../${userType}/${userType}-dashboard.html`;

    // Mock sales data (replace with actual API call in production)
    const salesData = [
        {
            cropId: "CRP001",
            buyerId: "BUY001",
            farmerId: "FRM001",
            cropName: "Rice",
            harvestDate: "2024-01-15",
            soldDate: "2024-01-20",
            quantity: "500 kg",
            soldAmount: 25000,
            totalExpense: 15000,
            profit: 10000
        },
        {
            cropId: "CRP002",
            buyerId: "BUY002",
            farmerId: "FRM001",
            cropName: "Wheat",
            harvestDate: "2024-01-10",
            soldDate: "2024-01-25",
            quantity: "400 kg",
            soldAmount: 20000,
            totalExpense: 12000,
            profit: 8000
        }
        // Add more mock data as needed
    ];

    function populateTable(data) {
        const tableBody = document.getElementById('salesTableBody');
        tableBody.innerHTML = '';

        data.forEach(sale => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${sale.cropId}</td>
                <td>${sale.buyerId}</td>
                <td>${sale.farmerId}</td>
                <td>${sale.cropName}</td>
                <td>${sale.harvestDate}</td>
                <td>${sale.soldDate}</td>
                <td>${sale.quantity}</td>
                <td>₹${sale.soldAmount}</td>
                <td>₹${sale.totalExpense}</td>
                <td class="${sale.profit >= 0 ? 'profit-positive' : 'profit-negative'}">
                    ₹${sale.profit}
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Initial table population
    populateTable(salesData);

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const filteredData = salesData.filter(sale => 
            sale.cropId.toLowerCase().includes(searchTerm) ||
            sale.cropName.toLowerCase().includes(searchTerm) ||
            sale.buyerId.toLowerCase().includes(searchTerm) ||
            sale.farmerId.toLowerCase().includes(searchTerm)
        );
        populateTable(filteredData);
    });

    // Date filter functionality
    document.getElementById('filterDates').addEventListener('click', function() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);

        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            alert('Please select valid dates');
            return;
        }

        const filteredData = salesData.filter(sale => {
            const soldDate = new Date(sale.soldDate);
            return soldDate >= startDate && soldDate <= endDate;
        });

        populateTable(filteredData);
    });

    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        sessionStorage.clear();
        window.location.href = '../auth/login.html';
    });
});