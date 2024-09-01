import re

# Helper function for natural sorting
def natural_key(string):
    # Splits string into a list of lowercase substrings and integers
    return [int(text) if text.isdigit() else text.lower() for text in re.split('([0-9]+)', string)]

def bubble_sort(arr):
    n = len(arr)
    # Perform Bubble Sort
    for i in range(n):
        for j in range(0, n - i - 1):
            # Compare two adjacent elements using the natural key
            if natural_key(arr[j]) > natural_key(arr[j + 1]):
                # Swap if the element found is greater than the next element
                arr[j], arr[j + 1] = arr[j + 1], arr[j]
    return arr

# Array of strings to sort
# arr = ['z1z', 'Z10', 'z12', 'Z2', 'z3']
# arr = ['z174z', 'Z1088', 'z8912', 'Z134423fs', 'z342423']

def get_integer_input(prompt):
    while True:
        try:
            value = int(input(prompt))
            return value
        except ValueError:
            print("Invalid input. Please enter a valid integer.")
# User input for the array
arr = []
# Getting the number of elements in the array
n = get_integer_input("Enter the number of elements in the array: ")

# Getting each element from the user
for i in range(n):
    element = input(f"Enter element {i + 1}: ")
    arr.append(element)

#input the arr
print(arr)

# Sort the array
sorted_arr = bubble_sort(arr)

# Display the sorted array
print(sorted_arr)



# After sorting, should become:

# array(
# 	'0' => 'z1z',
# 	'1' => 'Z2',
# 	'2' => 'z3',
# 	'3' => 'Z10',
# 	'4' => 'z12',
# )