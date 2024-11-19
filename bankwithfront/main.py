from flask import Flask, request, jsonify
import mysql.connector

from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Database connection function
def connect_to_db():
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",  # Replace with your MySQL root password
        database="banking_system"
    )
    return connection

# User registration endpoint
@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()
    username = data.get('username')
    password = data.get('password')

    if not username or not password:
        return jsonify({"error": "Username and password cannot be empty."}), 400

    conn = connect_to_db()
    cursor = conn.cursor()

    try:
        # Insert the new user and get the user_id

        cursor.execute("INSERT INTO users (username, password) VALUES (%s, %s)", (username, password))

        # Fetch the user_id from the result
        user_id = cursor.fetchone()[0]

        # Now insert the user_id into the accounts table for balance
        cursor.execute("INSERT INTO accounts (user_id) VALUES (%s)", (user_id,))
        conn.commit()
        return jsonify({"message": "User registered successfully!"}), 201
    except mysql.connector.IntegrityError as e:
        if "Duplicate entry" in str(e):
            return jsonify({"error": "Username already exists."}), 409
        else:
            return jsonify({"error": "An error occurred."}), 500
    finally:
        cursor.close()
        conn.close()

# User login endpoint
@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    username = data.get('username')
    password = data.get('password')

    conn = connect_to_db()
    cursor = conn.cursor()

    cursor.execute("SELECT id FROM users WHERE username=%s AND password=%s", (username, password))
    user = cursor.fetchone()

    if user:
        return jsonify({"code":"200","message": "Login successful!", "user_id": user[0]}), 200
    else:
        return jsonify({"code":"210","message": "Invalid username or password.","user_id": ''}), 401

# Deposit endpoint
@app.route('/deposit', methods=['POST'])
def deposit():
    data = request.get_json()
    user_id = data.get('user_id')
    amount = data.get('amount')
    if amount is None:
        amount= 0

    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("UPDATE accounts SET balance = balance + %s WHERE user_id=%s", (amount, user_id))
    cursor.execute("INSERT INTO deposite (user_id, deposite_amount) VALUES (%s, %s)", (user_id, amount))
    
    conn.commit()
    cursor.close()
    conn.close()

    return jsonify({"message": f"Deposited: {amount}"}), 200

# Show balance endpoint
@app.route('/balance/<int:user_id>', methods=['GET'])
def show_balance(user_id):
    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("SELECT balance FROM accounts WHERE user_id=%s", (user_id,))
    result = cursor.fetchone()
    
    if result:
        return jsonify({"balance": result[0]}), 200
    else:
        # cursor.execute("INSERT INTO accounts (user_id) VALUES (%s)", (user_id,))
        # conn.commit()
        
        # cursor.execute("SELECT balance FROM accounts WHERE user_id=%s", (user_id,))
        # result = cursor.fetchone()
        # return jsonify({"balance": result[0]}), 200
        return jsonify({"error": "No account found for this user."}), 404
    

    # Create an account for a new user
def create_account(user_id):
    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO accounts (user_id) VALUES (%s)", (user_id,))
    conn.commit()
    print("Account created successfully.")
    cursor.close()
    conn.close()

@app.route('/withdraw', methods=['POST'])
def withdraw():
    data = request.get_json()
    user_id = data.get('user_id')
    amount = data.get('amount')

    if amount is None:
        amount=0
    conn = connect_to_db()
    cursor = conn.cursor()

    cursor.execute("UPDATE accounts SET balance = balance - %s WHERE user_id=%s", (amount, user_id))
    cursor.execute("INSERT INTO withdraw (user_id, withdraw_amount) VALUES (%s, %s)", (user_id, amount))
    conn.commit()
    cursor.close()
    conn.close()

    return jsonify({"message": f"Withdrew: {amount}"}), 200
if __name__ == '__main__':
    app.run(debug=True)
