const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();

app.use(bodyParser.urlencoded({ extended: true }));

// MySQL connection setup
const db = mysql.createConnection({
    host: 'localhost',
    user: 'your-username',
    password: 'your-password',
    database: 'your-database'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL Database.');
});

// Route to handle form submission
app.post('/addmember', (req, res) => {
    const { name, gender, address, phone, hometown } = req.body;
    const sql = 'INSERT INTO AddMember (name, gender, address, phone, hometown) VALUES (?, ?, ?, ?, ?)';
    db.query(sql, [name, gender, address, phone, hometown], (err, result) => {
        if (err) throw err;
        res.send('Member added successfully.');
    });
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
