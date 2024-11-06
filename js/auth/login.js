const TEST_CREDENTIALS = {
    farmer: {
        userId: 'f123',
        password: '123'
    },
    agent: {
        userId: 'ag123',
        password: '123'
    },
    analyst: {
        userId: 'an123',
        password: '123'
    },
    buyer: {
        userId: 'b123',
        password: '123'
    },
    seller: {
        userId: 's123',
        password: '123'
    }
};

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const userType = document.getElementById('userType').value;
    const userId = document.getElementById('userId').value;
    const password = document.getElementById('password').value;

    if (TEST_CREDENTIALS[userType] && 
        TEST_CREDENTIALS[userType].userId === userId && 
        TEST_CREDENTIALS[userType].password === password) {
        
        sessionStorage.setItem('userType', userType);
        sessionStorage.setItem('userId', userId);

        switch(userType) {
            case 'farmer':
                window.location.href = '../farmer/farmer-dashboard.html';
                break;
            case 'agent':
                window.location.href = '../agent/agent-dashboard.html';
                break;
            case 'analyst':
                window.location.href = '../analyst/analyst-dashboard.html';
                break;
            case 'buyer':
                window.location.href = '../buyer/buyer-dashboard.html';
                break;
            case 'seller':
                window.location.href = '../seller/seller-dashboard.html';
                break;
            default:
                alert('Invalid user type');
        }
    } else {
        alert('Invalid credentials! Please check your User ID and Password');
    }
});