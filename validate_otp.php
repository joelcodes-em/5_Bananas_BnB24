<?php
include 'connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['signup_otp'])) {
    $otp = $_POST['otp'];
    $stored_otp = $_SESSION['signup_otp'];

    // Compare submitted OTP with stored OTP
    if ($otp == $stored_otp) {
        // OTP validated successfully
        // Now proceed with user registration
        $username = $_SESSION['signup_username'];
        $password = $_SESSION['signup_password'];

        // Here you can save the username and password to the database
        // Replace this with your own logic
        echo "User registered successfully.";

        // Clear session variables
        unset($_SESSION['signup_username']);
        unset($_SESSION['signup_password']);
        unset($_SESSION['signup_otp']);
    } else {
        echo "Invalid OTP. Please try again.";
    }
} else {
    // Redirect to signup page if accessed directly or OTP is not set
    header("Location: signup.html");
    exit();
}
?>
