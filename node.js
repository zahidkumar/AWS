const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
// Parse incoming JSON data
app.use(bodyParser.json());

// Set up MySQL connection (change the host, user, password, and database)
const connection = mysql.createConnection({
    host: '', // e.g. "mydbinstance.us-west-2.rds.amazonaws.com"
    user: 'admin',
    password: 'admin123',
    database: 'data'
});

// Connect to the database
connection.connect(err => {
    if (err) {
        console.error('Error connecting to the database:', err.stack);
        return;
    }
    console.log('Connected to the database.');
});

// Route to save data to RDS
app.post('/save', (req, res) => {
    const { name, email } = req.body;
    const query = 'INSERT INTO users (name, email) VALUES (?, ?)';

    connection.query(query, [name, email], (err, results) => {
        if (err) {
            console.error('Error inserting data:', err);
            return res.status(500).json({ message: 'Error saving data' });
        }

        res.status(200).json({ message: 'Data saved successfully' });
    });
});

// Start the server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
