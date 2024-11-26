Run the Flask Backend:
pip install flask mysql-connector-python

Start the Flask backend by running the command:
bash
Copy code
    python app.py
Ensure that the Flask app is running and listening on port 5000 (or any port you choose).
Open the HTML Form:

Open the HTML file in a browser.
Enter some data (e.g., name and email) and click Submit.
The data will be sent to the Flask backend, which will save it to your RDS MySQL database.
Check the Database:

After submitting the form, you should see the new record inserted into your MySQL table on RDS.
4. Security and Considerations:
Cross-Origin Resource Sharing (CORS): If your frontend and backend are hosted on different domains or ports, you might need to enable CORS in your Flask app. You can use the Flask-CORS extension:

bash
Copy code
pip install flask-cors
And then add this to your Flask app:

python
Copy code
from flask_cors import CORS
CORS(app)
Database Credentials: Never hardcode sensitive data like your RDS password directly in the code. Use environment variables or configuration files to store credentials securely.

Validation: Ensure that the data sent by the user is properly validated and sanitized to avoid SQL injection and other security risks.

Summary:
Frontend (HTML): A simple HTML form that collects data from the user and sends it to the Flask backend.
Backend (Flask): A Flask app that handles the POST request, saves the data to the RDS MySQL database, and returns a success message.
RDS (MySQL): The data is inserted into your MySQL database hosted on RDS.
This setup allows you to collect data from a user and save it to your RDS MySQL database using Python (Flask) and HTML.


==============================
vim index.html
  191  sudo vim index.html
  192  sudo systemctl status httpd
  193  sudo systemctl start httpd
  194  sudo yum install mysql
  195  curl -fsSL https://rpm.nodesource.com/setup_16.x | sudo bash -
  196  sudo yum update -y
  197  sudo yum install -y nodejs
  198  node -v
  199  npm -v
  200  mysql
  201  sudo yum remove mysql
  202  npm install express mysql2 body-parser
  203  mysql
  204  sudo npm install express mysql2 body-parser
  205  cd
  206  ls /var/www/html/
  207  cd /var/www/html/
  208  mysql
  209  sudo yum install mysql -y
  210  mysql -h database-1.cv2o8o4me44x.ap-south-1.rds.amazonaws.com -u admin -padmin123
  211  ls
  212  sudo vim Node.js
  213  sudo npm init -y
  214  sudo su
  node Node.js 
    2  vim Node.js 
    3  vim Node.js 
    4  cat index.html 
    5  node Node.js 
    6  vim Node.js 
    7  node Node.js 
    8  exit
    9  cd /var/www/html/
   10  npm install cors
