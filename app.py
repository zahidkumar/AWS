from flask import Flask, request, jsonify
import mysql.connector

app = Flask(__name__)

# Connect to the MySQL RDS database
def get_db_connection():
    connection = mysql.connector.connect(
        host='your-rds-endpoint',  # Replace with your RDS endpoint
        user='your-db-username',   # Replace with your RDS username
        password='your-db-password',  # Replace with your RDS password
        database='your-database-name'  # Replace with your RDS database name
    )
    return connection

@app.route('/save-data', methods=['POST'])
def save_data():
    # Get the data from the form (JSON format)
    data = request.get_json()
    
    name = data.get('name')
    email = data.get('email')

    # Establish DB connection
    conn = get_db_connection()
    cursor = conn.cursor()

    # Insert data into the table (replace 'your_table_name' with your actual table)
    cursor.execute('INSERT INTO your_table_name (name, email) VALUES (%s, %s)', (name, email))
    conn.commit()

    cursor.close()
    conn.close()

    return jsonify({"message": "Data saved successfully!"})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
