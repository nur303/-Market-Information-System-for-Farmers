const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const session = require('express-session');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(session({
    secret: 'your_secret_key',
    resave: false,
    saveUninitialized: true
}));

const db = mysql.createConnection({
    host: 'localhost',
    user: 'your_db_user',
    password: 'your_db_password',
    database: 'your_db_name'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Database connected.');
});

app.post('/login', (req, res) => {
    const userID = req.body.userID;
    const password = req.body.password;

    const sql = 'SELECT * FROM USER_T WHERE userID = ? AND password_s = ?';
    db.query(sql, [userID, password], (err, result) => {
        if (err) throw err;

        if (result.length > 0) {
            const user = result[0];
            if (user.type === 'Customer') {
                res.redirect('/customer/index.html');
            } else if (user.type === 'Vendor') {
                res.redirect('/vendor/index.html');
            } else if (user.type === 'Farmer') {
                res.redirect('/farmer/index.html');
            }
        } else {
            res.send("<script>alert('Invalid User ID or password'); window.history.back();</script>");
        }
    });
});

app.listen(3000, () => {
    console.log('Server is running on port 3000.');
});