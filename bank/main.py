import mysql.connector
from getpass import getpass

# Connect to the MySQL database
def connect_to_db():
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="banking_system"
    )
    return connection

# User registration function
def register():
    username = input("Enter a username: ")
    password = input("Enter a password: ")

    if not username or not password:
        print("Username and password cannot be empty.")
        return
    conn = connect_to_db()
    cursor = conn.cursor()

    try:
        # Log the SQL query for debugging
        print(f"Attempting to register user: {username}")
        
        cursor.execute("INSERT INTO users (username, password) VALUES (%s, %s)", (username, password))
        conn.commit()
        print("User registered successfully!")
    except mysql.connector.IntegrityError as e:
        print(f"Database error: {e}")
        if "Duplicate entry" in str(e):
            print("Username already exists. Please try a different one.")
        else:
            print(f"An error occurred during registration: {e}")
    except Exception as e:
        print(f"An unexpected error occurred: {e}")
    finally:
        cursor.close()
        conn.close()


# User login function
def login():
    username = input("Enter your username: ")
    password = input("Enter your password: ")
    
    conn = connect_to_db()
    cursor = conn.cursor()

    cursor.execute("SELECT id FROM users WHERE username=%s AND password=%s", (username, password))
    user = cursor.fetchone()
    
    if user:
        print("Login successful!")
        return user[0]  # Return the user ID
    else:
        print("Invalid username or password.")
        return None

# Show main balance for the logged-in user
def show_main_balance(user_id,cursor):
    cursor.execute("SELECT balance FROM accounts WHERE user_id=%s", (user_id,))
    result = cursor.fetchone()
    
    if result:
        print(f"Your current balance is: {result[0]}")
    else:
        print("No account found for this user.")

# Show balance for the logged-in user
def show_balance(user_id):
    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("SELECT balance FROM accounts WHERE user_id=%s", (user_id,))
    result = cursor.fetchone()
    
    if result:
        print(f"Your current balance is: {result[0]}")
    else:
        print("No account found for this user.")
    
    cursor.close()
    conn.close()

# Deposit money into the user's account
def deposit(user_id):
    amount = float(input("Enter the amount to deposit: "))
    if amount > 0:
        conn = connect_to_db()
        cursor = conn.cursor()
        cursor.execute("UPDATE accounts SET balance = balance + %s WHERE user_id=%s", (amount, user_id))
        conn.commit()
        print(f"\nDeposited: {amount}")
        print("\n===================Main balance=======================")
        show_main_balance(user_id,cursor)
        print("========================================================\n")
        cursor.close()
        conn.close()
    else:
        print("Invalid amount.")

# Withdraw money from the user's account
def withdraw(user_id):
    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("SELECT balance FROM accounts WHERE user_id=%s", (user_id,))
    result = cursor.fetchone()
    
    if result:
        balance = result[0]
        amount = float(input("Enter the amount to withdraw: "))
        if 0 < amount <= balance:
            cursor.execute("UPDATE accounts SET balance = balance - %s WHERE user_id=%s", (amount, user_id))
            conn.commit()
            print(f"\nWithdrew: {amount}")
            print("\n===================Main balance=======================")
            show_main_balance(user_id,cursor)
        else:
            print("Invalid amount or insufficient balance.")
    else:
        print("No account found for this user.")
    
    cursor.close()
    conn.close()

# Create an account for a new user
def create_account(user_id):
    conn = connect_to_db()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO accounts (user_id) VALUES (%s)", (user_id,))
    conn.commit()
    print("Account created successfully.")
    cursor.close()
    conn.close()

# Main program logic
def main():
    is_running = True
    user_id = None

    while is_running:
        if user_id is None:
            print("\nWelcome to the Banking Program:")
            print("1: Register")
            print("2: Login")
            print("3: Exit")
            choice = input("Enter your choice (1-3): ")

            if choice == '1':
                register()
            elif choice == '2':
                user_id = login()
                if user_id is None:
                    # Check if the user has an account; if not, create one
                    # create_account(user_id)
                    print("\nUser not found")
                    print("\nPlease registe a user")
            elif choice == '3':
                is_running = False
                print("*****************************************************************************")
                print("Thank you for using this banking system")
                print("Exiting the program...")
                print("*****************************************************************************")
            else:
                print("Please enter a valid option.")
        else:
            print("\nBanking Options:")
            print("1: Show Balance")
            print("2: Deposit")
            print("3: Withdraw")
            print("4: Logout")
            choice = input("Enter your choice (1-4): ")

            if choice == '1':
                show_balance(user_id)
            elif choice == '2':
                deposit(user_id)
            elif choice == '3':
                withdraw(user_id)
            elif choice == '4':
                user_id = None
                print("Logged out.")
            else:
                print("Please enter a valid option.")

if __name__ == "__main__":
    main()
