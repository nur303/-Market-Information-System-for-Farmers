document.addEventListener('DOMContentLoaded', function() {
    // Check authentication
    const userId = sessionStorage.getItem('userId');
    const userType = sessionStorage.getItem('userType');

    if (!userId || userType !== 'farmer') {
        window.location.href = '../auth/login.html';
        return;
    }

    // Mock data - Replace with actual API calls
    const farmerData = {
        id: 'FRM001',
        name: 'John Doe',
        phone: '+91 9876543210',
        email: 'john.doe@example.com',
        location: 'Karnataka, India',
        registrationDate: '2024-01-01'
    };

    // Update profile information
    document.getElementById('farmerId').textContent = farmerData.id;
    document.getElementById('farmerName').textContent = farmerData.name;
    document.getElementById('profile-name').textContent = farmerData.name;
    document.getElementById('profile-phone').textContent = farmerData.phone;
    document.getElementById('profile-email').textContent = farmerData.email;
    document.getElementById('profile-area_location').textContent = farmerData.location;
    document.getElementById('profile-regdate').textContent = farmerData.registrationDate;

    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        sessionStorage.clear();
        window.location.href = '../auth/login.html';
    });
});