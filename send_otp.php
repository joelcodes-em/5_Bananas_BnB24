<?php
include 'connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Save username and password in session for verification in next step
    $_SESSION['signup_username'] = $username;
    $_SESSION['signup_password'] = $password;

    // Generate and send OTP to the user (you need to implement your OTP sending logic here)
    $otp = generateOTP();

    // Store OTP in session
    $_SESSION['signup_otp'] = $otp;

    // Redirect to OTP verification page
    header("Location: verify_otp.php");
    exit();
} else {
    // Redirect to signup page if accessed directly without form submission
    header("Location: signup.php");
    exit();
}

function generateOTP() {
    // Generate a random OTP (you can customize the length as needed)
    return mt_rand(100000, 999999);
}
?>
