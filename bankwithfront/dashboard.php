<?php
session_start();

$user_id='';
// Check if the 'username' data was sent via POST
if (isset($_SESSION['user_id'])) {
    // Get the localStorage data sent from JavaScript
    $user_id = $_SESSION['user_id'];
}

// Check if the session has expired (more than 10 minutes)
if (time() > $_SESSION['session_expire']) {
    // If expired, clear session and redirect to login
    session_unset(); // Clear session variables
    session_destroy(); // Destroy the session
    header('Location: index.php'); // Redirect to login
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/common.css">
</head>

<body cz-shortcut-listen="true">
    <!-- Display the dashboard only if user_id is not empty -->
    <?php if (!empty($user_id)): ?>
    <div id="dashboard">
        <h2>You are in Home</h2>
        <button onclick="checkBalance()">Check Balance</button>
        <button onclick="deposit()">Deposit Money</button>
        <button onclick="withdraw()">Withdraw Money</button>
        <button id="openModalBtn">Update Customer profile</button>
        <p id="balanceInfo"></p>
    </div>
    <?php else: ?>
    <div>
        <h2>User is not logged in</h2>
        <p>Please log in to access the dashboard.</p>
    </div>
    <?php endif; ?>

    <script>

        document.getElementById("openModalBtn").onclick = function() {
            swal({
                title: "Customer Information",
                text: "Please enter the customer's name and email:",
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                            <style>
                                .form-container {
                                    display: flex;
                                    flex-wrap: wrap;
                                    gap: 10px;
                                }
                                .form-group {
                                    display: flex;
                                    flex-direction: column;
                                    flex: 1;
                                    min-width: 45%; /* Adjust the width so they don't overlap */
                                }
                                label {
                                    font-weight: bold;
                                    font-size: 14px;
                                    margin-bottom: 5px;
                                    text-align: left;
                                }
                                input[type="text"],
                                input[type="email"] {
                                    width: 100%;
                                    padding: 8px;
                                    font-size: 14px;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;
                                    box-sizing: border-box;
                                }
                                input[type="date"] {
                                    width: 100%;
                                    padding: 8px;
                                    font-size: 14px;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;
                                    box-sizing: border-box;
                                }
                                input[type="file"] {
                                    width: 100%;
                                    padding: 8px;
                                    font-size: 14px;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;
                                    box-sizing: border-box;
                                }
                                input[type="number"] {
                                    width: 100%;
                                    padding: 8px;
                                    font-size: 14px;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;
                                    box-sizing: border-box;
                                }
                                input[type="text"]:focus,
                                input[type="email"]:focus {
                                    outline: none;
                                    border-color: #5cb85c;
                                }
                                input[type="date"]:focus {
                                    outline: none;
                                    border-color: #5cb85c;
                                }
                                input[type="file"]:focus {
                                    outline: none;
                                    border-color: #5cb85c;
                                }
                                input[type="number"]:focus {
                                    outline: none;
                                    border-color: #5cb85c;
                                }                            
                            </style>
                            <div class="form-container">
                                <div class="form-group">
                                    <label for="customerFName">First Name:</label>
                                    <input type="text" id="customerFName" placeholder="First Name" />
                                </div>
                                <div class="form-group">
                                    <label for="customerLName">Last Name:</label>
                                    <input type="text" id="customerLName" placeholder="Last Name" />
                                </div>
                                <div class="form-group">
                                    <label for="customerEmail">Email:</label>
                                    <input type="email" id="customerEmail" placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <label for="contactnumber">Phone Number:</label>
                                    <input type="text" id="contactnumber" placeholder="Phone Number Allow only digits"
                                        maxlength="11"
                                        oninput="validateNumberInput(this, 11)" />
                                </div>
                                <div class="form-group">
                                    <label for="nid">NID Number:</label>
                                    <input type="text" id="nid" placeholder="NID Number  Allow only digits"
                                        maxlength="17"
                                        oninput="validateNumberInput(this, 17)" />
                                </div>
                                <div class="form-group">
                                    <label for="contactnumber">Date of Birth:</label>
                                <input type="date" id="dob" placeholder="Date of Birth" />
                                </div>
                                <div class="form-group">
                                    <label for="profilepic">Profile Picture (PNG/JPG, max 1MB):</label>
                                    <input type="file" id="profilepic" name="profilepic" accept="image/png, image/jpeg" />
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group">
                                    <label for="nidpic">NID Picture (PNG/JPG, max 1MB):</label>
                                    <input type="file" id="nidpic" name="nidpic" accept="image/png, image/jpeg" />
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group">
                                    <label for="p_address">Present Address:</label>
                                    <input type="text" id="p_address" name="p_address" placeholder="Present Address" />
                                </div>
                            </div>
                            
                            <div class="form-container">
                                    <div class="form-group">
                                    <label for="per_address">Permanent Address:</label>
                                    <input type="text" id="per_address" name="per_address" placeholder="Permanent Address" />
                                </div>
                            </div>
                        `
                    }
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Submit",
                        closeModal: false, // Keep the modal open for validation
                    },
                },
                closeOnClickOutside: false, // Prevent modal from closing when clicking outside
                closeOnEsc: false // Prevent modal from closing when pressing the Escape key
            })
            .then((willSubmit) => {
                if (willSubmit) {
                    const firstName = document.getElementById("customerFName").value;
                    const lastName = document.getElementById("customerLName").value;
                    const email = document.getElementById("customerEmail").value;
                    const phoneNumber = document.getElementById("contactnumber").value;
                    const dob = document.getElementById("dob").value;
                    const presentAddress = document.getElementById("p_address").value;
                    const permanentAddress = document.getElementById("per_address").value;
                    const profilePic = document.getElementById("profilepic").files[0];
                    console.log(`First Name: ${firstName}, Last Name: ${lastName}, Email: ${email}, Phone Number: ${phoneNumber}, Date of Birth: ${dob}, Present Address: ${presentAddress}, Permanent Address: ${permanentAddress}, Profile Picture: ${profilePic.name}`);

                    // Validate inputs
                    if (!firstName || !lastName || !email) {
                        swal("Error", "Both fields are required!", "error");
                        return false; // Prevent closing the modal
                    }
                    // Validate file type (must be PNG or JPG)
                    const allowedTypes = ['image/jpeg', 'image/png'];
                    if (!allowedTypes.includes(profilePic.type)) {
                        swal("Error", "Only PNG and JPG formats are allowed!", "error");
                        return false;
                    }

                    // Validate file size (must be less than 1MB)
                    const maxSizeInBytes = 1 * 1024 * 1024; // 1MB in bytes
                    if (profilePic.size > maxSizeInBytes) {
                        swal("Error", "Profile picture must be smaller than 1MB!", "error");
                        return false;
                    }
                    console.log(`First Name: ${firstName}, Last Name: ${lastName}, Email: ${email}, Phone Number: ${phoneNumber}, Date of Birth: ${dob}, Present Address: ${presentAddress}, Permanent Address: ${permanentAddress}, Profile Picture: ${profilePic.name}`);
                    swal("Success!", "Customer information submitted!", "success");
                }
            });

        };
        // Function to validate number input and restrict length
        function validateNumberInput(input, maxLength) {
            input.value = input.value.replace(/[^0-9]/g, ''); // Allow only digits
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength); // Limit input to maxLength
            }
        }
    </script>
    <script>

        // Check balance
        function checkBalance() {
            const userId = localStorage.getItem("user_id");

            fetch(`http://127.0.0.1:5000/balance/${userId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById("balanceInfo").textContent = `Your balance is: ${data.balance}`;
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        // Deposit money
        function deposit() {
            const userId = localStorage.getItem("user_id");
            const amount = prompt("Enter amount to deposit:");

            fetch('http://127.0.0.1:5000/deposit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId, amount: amount }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                checkBalance();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        // Withdraw money (similar to deposit function)
        function withdraw() {
            const userId = localStorage.getItem("user_id");
            const amount = prompt("Enter amount to withdraw:");

            fetch('http://127.0.0.1:5000/withdraw', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId, amount: amount }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);                
                checkBalance();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }// Withdraw money (similar to deposit function)
        function profile() {
            const userId = localStorage.getItem("user_id");
            const amount = prompt("Enter amount to withdraw:");

            fetch('http://127.0.0.1:5000/withdraw', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId, amount: amount }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);                
                checkBalance();
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
}

.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 300px; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
