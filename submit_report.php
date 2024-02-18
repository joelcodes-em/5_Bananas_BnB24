<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle quick report form submission
    if (isset($_POST['quick_submit'])) {
        // Process data from the quick report form
        $quick_report = $_POST['report']; // Retrieve the one-line report

        // Perform further processing, such as saving to database or sending emails
        
        // Redirect after submission
        header("Location: thank_you.php");
        exit();
    }

    // Handle detailed report form submission
    if (isset($_POST['detailed_submit'])) {
        // Process data from the detailed report form
        $detailed_report = $_POST['report']; // Retrieve the detailed report
        $person_involved = $_POST['Person']; // Retrieve the person involved
        $corruption_type = $_POST['corruption_type']; // Retrieve the type of corruption
        $other_field = isset($_POST['other_field']) ? $_POST['other_field'] : ''; // Retrieve other field if selected
        // Handle file uploads (geotag image and evidence) as needed

        // Perform further processing, such as saving to database or sending emails
        
        // Redirect after submission
        header("Location: thank_you.php");
        exit();
    }
}
?>