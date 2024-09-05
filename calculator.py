# # Function for addition
# def add(x, y):
#     return x + y

# # Function for subtraction
# def subtract(x, y):
#     return x - y

# # Function for multiplication
# def multiply(x, y):
#     return x * y

# # Function for division
# def divide(x, y):
#     if y == 0:
#         return "Error! Division by zero."
#     else:
#         return x / y

# # Main function to use the calculator
# def calculator():
#     print("Select operation:")
#     print("1. Add")
#     print("2. Subtract")
#     print("3. Multiply")
#     print("4. Divide")
    
#     choice = input("Enter choice(1/2/3/4): ")

#     num1 = float(input("Enter first number: "))
#     num2 = float(input("Enter second number: "))

#     if choice == '1':
#         print(f"The result is: {add(num1, num2)}")
#     elif choice == '2':
#         print(f"The result is: {subtract(num1, num2)}")
#     elif choice == '3':
#         print(f"The result is: {multiply(num1, num2)}")
#     elif choice == '4':
#         print(f"The result is: {divide(num1, num2)}")
#     else:
#         print("Invalid input")

# # Run the calculator
# calculator()

import tkinter as tk

# Function to evaluate the expression
def evaluate_expression():
    try:
        expression = entry.get()
        result = eval(expression)
        entry.delete(0, tk.END)
        entry.insert(tk.END, str(result))
    except Exception:
        entry.delete(0, tk.END)
        entry.insert(tk.END, "Error")

# Function to add text to the entry widget
def add_to_expression(value):
    entry.insert(tk.END, value)

# Function to clear the entry widget
def clear_expression():
    entry.delete(0, tk.END)

# Create the main window
window = tk.Tk()
window.title("Beautiful Calculator")
window.configure(bg="#2E2E2E")

# Create an entry widget for the expression
entry = tk.Entry(window, width=16, font=("Arial", 24), borderwidth=0, relief="solid", justify="right")
entry.grid(row=0, column=0, columnspan=4, pady=(10, 20), padx=10)
entry.configure(bg="#3C3C3C", fg="white", insertbackground="white")

# Button styles
button_style = {
    "font": ("Arial", 18),
    "width": 5,
    "height": 2,
    "bg": "#4CAF50",   # Green color
    "fg": "white",
    "activebackground": "#388E3C",
    "activeforeground": "white",
    "borderwidth": 0,
    "relief": "flat"
}

operator_style = button_style.copy()
operator_style["bg"] = "#F57C00"  # Orange color
operator_style["activebackground"] = "#EF6C00"

equal_style = button_style.copy()
equal_style["bg"] = "#0288D1"     # Blue color
equal_style["activebackground"] = "#0277BD"

clear_style = button_style.copy()
clear_style["bg"] = "#D32F2F"     # Red color
clear_style["activebackground"] = "#C62828"

# Create buttons for digits and operators
buttons = [
    ('7', 1, 0), ('8', 1, 1), ('9', 1, 2), ('/', 1, 3),
    ('4', 2, 0), ('5', 2, 1), ('6', 2, 2), ('*', 2, 3),
    ('1', 3, 0), ('2', 3, 1), ('3', 3, 2), ('-', 3, 3),
    ('0', 4, 0), ('.', 4, 1), ('+', 4, 2), ('+/-', 4, 3),
]

# Add buttons to the window
for (text, row, col) in buttons:
    style = button_style if text not in ('/', '*', '-', '+') else operator_style
    button = tk.Button(window, text=text, command=lambda t=text: add_to_expression(t), **style)
    button.grid(row=row, column=col, padx=5, pady=5)

# Add equal button
equal_button = tk.Button(window, text='=', command=evaluate_expression, **equal_style)
equal_button.grid(row=4, column=3, padx=5, pady=5)

# Add clear button
clear_button = tk.Button(window, text='C', command=clear_expression, **clear_style)
clear_button.grid(row=5, column=0, columnspan=4, sticky="we", padx=5, pady=(5, 10))

# Run the GUI event loop
window.mainloop()
