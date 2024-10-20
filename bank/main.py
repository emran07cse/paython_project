def show_balance():
    global balance
    print(f"Your current balance is: {balance}")

def deposit():
    global balance
    amount = float(input("Enter the amount to deposit: "))
    if amount > 0:
        balance += amount
        print(f"Deposited: {amount}")
    else:
        print("Invalid amount.")

def withdraw():
    global balance
    amount = float(input("Enter the amount to withdraw: "))
    if 0 < amount <= balance:
        balance -= amount
        print(f"Withdrew: {amount}")
    else:
        print("Invalid amount or insufficient balance.")

balance = 0
is_running = True

while is_running:
    print("Banking Program:")
    print("1: Show Balance")
    print("2: Deposit")
    print("3: Withdraw")
    print("4: Exit")

    choice = input("Enter your choice (1-4): ")

    if choice == '1':
        show_balance()

    elif choice == '2':
        deposit()

    elif choice == '3':
        withdraw()

    elif choice == '4':
        is_running = False
        print("Exiting the program...")

    else:
        print("Please enter a valid option.")
