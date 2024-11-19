

<?php

session_start();
session_destroy();
session_start();
// Set session expiration time (in seconds)
// $session_duration = 600; // 10 minutes
// $session_expire_time = time() + $session_duration; // Current time + session duration


// $_SESSION['user_id'] = $user_id;
// $_SESSION['session_expire'] = $session_expire_time;
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
    <div id="app" data-v-app="">
        <div>
            <!-- <form id="loginForm" action="login.php" method="post"> -->
            <form action="login.php" method="post">
                <div class="login_page" >
                    <div class="login_page_form_section" >
                        <div class="pt-3 pb-3" >
                            <div class="text-center" >
                                <a href=""><img id="logo-only" src="img/only-logo.78463dd4.png" alt=""></a>
                                <h3>Welcome</h3><p class="text-secondary"> Welcome to Banking System Platform </p>
                            </div>
                        </div><!-- <hr> -->
                        <div class="card login_form_card" >
                            <div class="login_form_card_title" >
                                <h3 class="pt-2" >Sign In</h3>
                                <p class="text-secondary"  style="font-size: 0.7em; font-style: italic;">Please enter your merchant wallet number and password to sign in</p>
                            </div>
                            <form >
                                <div class="mb-4" >
                                    <label for="InputUsername" class="form-label login_form_card_label" >Username:</label>
                                    <div class="position-relative" >
                                        <input type="tel" maxlength="11" class="form-control custom_input ps_2rem" id="loginUsername" name="username" required="" >
                                        <!-- <input type="text" id="loginUsername" name="username" required><br><br> -->

                                        <!-- <i class="bi bi-phone phone_icon" ></i> -->
                                    </div>
                                    <p class="text-danger" ></p>
                                </div>
                                <div class="mb-4" >
                                    <label for="InputPassword" class="form-label login_form_card_label" >Password</label>
                                    <div class="position-relative" >
                                        <input id="loginPassword" name="password" type="password" class="form-control custom_input" placeholder="......" required="" >
                                        <!-- <span class="icon" ><i class="fas text-secondary pointer fa-eye-slash" ></i></span> -->
                                    </div>
                                </div>
                                <div class="mb-3" >
                                    <div class="form-check" >
                                        <input class="form-check-input" type="checkbox" id="RememberMe" value="" >
                                        <label class="form-check-label" for="RememberMe" > Remember Me </label>
                                        <a class="float-end forget_pass_btn" >Forgot password?</a>
                                    </div>
                                </div>
                                <div class="form-group text-center" >
                                    <input type="submit" class="btn_b_global" value="Sign in" ></div>
                            </form>
                            <p  style="text-decoration: none !important; font-weight: normal; color: black; text-align: center;"> Don't have an account?
                                <a class="btn btn-link btn-sm"  style="text-decoration: none !important; font-weight: normal; color: black;">
                                    <b  style="text-decoration: underline !important; font-weight: bold; color: rgb(226, 19, 110);">Sign Up</b>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
            <footer class="common_footer d-flex justify-content-center" data-v-83b37fbc="">
                <p class="mb-0 text_11px" data-v-83b37fbc=""> © <?php echo date('Y')?>&nbsp; All rights reserved </p>
            </footer>
        </div>
    </div>
    <h2></h2>
    <!-- <form id="loginForm">
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="username" required><br><br>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="password" required><br><br>

        <input type="submit" value="Login">
    </form> -->

    <div id="dashboard" style="display: none;">
        <h2>You are in Home </h2>
        <button onclick="checkBalance()">Check Balance</button>
        <button onclick="deposit()">Deposit Money</button>
        <button onclick="withdraw()">Withdraw Money</button>
        <button id="openModalBtn">Update Customer profile</button>
        <p id="balanceInfo"></p>
    </div>
    <!-- <div id="customerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Customer Information</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            <button onclick="profile()">Upload profile</button>
        </div>
    </div> -->
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
        // Login user
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const username = document.getElementById("loginUsername").value;
            const password = document.getElementById("loginPassword").value;

            fetch('http://127.0.0.1:5000/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: username, password: password }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert(data.user_id);
                    // Store user_id in local storage for future requests
                    // localStorage.setItem("user_id", data.user_id);
                    
                    // Hide login form and show dashboard
                    // document.getElementById("loginForm").style.display = "none";
                    // document.getElementById("dashboard").style.display = "block";

                    // similar behavior as clicking on a link
                    //window.location.href = "dashboard.php?user_id="+data.user_id;


                    // Set session expiration time (let's say 10 minutes from now)
                    const sessionDuration = 10 * 60 * 1000; // 10 minutes in milliseconds
                    const sessionExpireTime = new Date().getTime() + sessionDuration;
                    
                    // Store the expiration time in localStorage                    // Set user_id
                    localStorage.setItem('user_id', data.user_id);
                    localStorage.setItem('session_expire', data.user_id);
                    console.log( data.user_id);
                    // Redirect the user to the dashboard
                    window.location.href = "dashboard.php";

                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });

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

#app {
width: 100%;
}

.login_page_form_section {
max-width: 400px; /* Set the form's max width */
width: 100%; 
}
.login_page{
    height: 100%;
margin: 0;
display: flex;
justify-content: center;
align-items: center;
background-color: #f5f5f5;
}
.card {
padding: 20px;
background-color: white;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
border-radius: 10px;
}

.text-center {
    margin-bottom: 20px;
}

footer.common_footer {
    position: absolute;
    bottom: 10px;
    width: 100%;
    text-align: center;
    color: #666;
}

</style>

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
