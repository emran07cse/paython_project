<?php


session_start();
session_destroy();
session_start();
// Set session expiration time (in seconds)
$session_duration = 600; // 10 minutes
$session_expire_time = time() + $session_duration; // Current time + session duration

// Function to make a POST request using cURL
function loginUser($username, $password) {
    $url = 'http://127.0.0.1:5000/login'; // URL of your login endpoint

    // Create the payload as an associative array
    $data = [
        'username' => $username,
        'password' => $password
    ];

    // Initialize cURL
    $ch = curl_init($url);

    // Set the cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Set the content type to JSON
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send the JSON payload

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        // Handle error (e.g., connection error)
        echo 'Error: ' . curl_error($ch);
    } else {
        // Print or process the response
        return $response;
    }

    // Close cURL session
    curl_close($ch);
}

// Check if data is sent via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from POST data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Call the function to log in the user
    $data=loginUser($username, $password);
    $decodedData = json_decode($data, true); // Decode as associative array

    // Print the decoded data
    print_r($decodedData);
    
    if ($decodedData['code']=='200') {
        // Set session variables or handle successful login
        $_SESSION['user_id'] = $decodedData['user_id']; // Or some user ID from the response
        $_SESSION['session_expire'] = $session_expire_time;
        // Redirect to the dashboard
        header('Location: dashboard.php'); // Correct usage of header for redirection
        exit();
    } else {
        // Handle login failure
        echo json_encode(['success' => false, 'message' => $decodedData['message']]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
