<?php
  include 'connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
  

    // Prepare variables for storing form data
    $report = $_POST['report'];
    $person = $_POST['person'];
    $corruption_type = $_POST['corruption_type'];
    $other_field = $_POST['other_field']; // Only if "Other" option is selected
    $geo_image_tag = $_FILES['geo_image_tag']['name']; // Image file name
    $evidence = $_FILES['evidence']['name']; // Evidence file name

    // Move uploaded files to a desired directory (e.g., 'uploads/')
    move_uploaded_file($_FILES['geo_image_tag']['tmp_name'], 'uploads/' . $geo_image_tag);
    move_uploaded_file($_FILES['evidence']['tmp_name'], 'uploads/' . $evidence);

    // SQL query to insert form data into database
    $sql = "INSERT INTO reports (report, person, corruption_type, other_field, geo_image_tag, evidence) 
            VALUES (:report, :person, :corruption_type, :other_field, :geo_image_tag, :evidence)";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':report', $report);
    $stmt->bindParam(':person', $person);
    $stmt->bindParam(':corruption_type', $corruption_type);
    $stmt->bindParam(':other_field', $other_field);
    $stmt->bindParam(':geo_image_tag', $geo_image_tag);
    $stmt->bindParam(':evidence', $evidence);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect to a success page
        echo "Report submitted successfully.";
    } else {
        // Redirect to an error page
        echo "Error: " . $errorInfo[2];
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: report.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    
	<title>Bananas Portal</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
</head>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url(./assets/images/reportbg.jpg);
            background-size: cover;
            padding-top: 40px;
        }
        h1 {
            color: #ffffff;
        }
        p{
            color: white;
        }
        form {
            background-color: #f9f9f9;
            color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            max-width: 550px;
            margin: auto;
            background-color: rgba(0, 0, 0, 0.5);;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input,option{
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
        input{
            pad: 15px;
        }
        .container{
            background-color: rgba(0, 0, 0, 0.5);
        }
        select {
        width: 100%;
        color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: rgba(0, 0, 0, 0.5);
        font-size: 16px;
        display: flex;
        align-items: center;
        }
        input[type="text"], textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="File"]{
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        textarea{
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
        input[type="submit"] {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        button{
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .detailed-form {
            display: none;
        }
        .quick-form {
            display: block;
        }
    </style>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    
</head>
<?php include 'header.php'; ?>
<body>
    <h1>Report Corruption</h1>
    <p>Your report is anonymous. We do not track your personal data.</p>
    <div id="buttons">
        <button onclick="quickForms()">Quick Report</button>
        <button onclick="detailedForms()">Detailed Report</button>
<script>
    function quickForms() {
        // Redirect to quick report PHP file
        tab.location.href = 'quick_repo.php';
    }

    function detailedForms() {
        // Redirect to detailed report PHP file
        tab.location.href = 'detailed_repo.php';
    }
</script>
    <form action="submit_report.php" method="post" enctype="multipart/form-data" class="detailed-form">

        <label for="report">Describe the incident:</label><br>
        <textarea id="report" name="report" required style="width: 462px; height: 191px"></textarea><br>

        <label for="person">Person Involved:</label><br>
        <input type="text" id="Per  son" name="Person"><br>

        <label for="corruption_type">Type of Corruption:</label><br>
        <div id="container">
        <select id="corruption_type" name="corruption_type" onchange="checkOther(this)">
            <option value="bribery">Bribery</option>
            <option value="embezzlement">Embezzlement</option>
            <option value="mof">Misuse of public funds</option>
            <option value="fraud">fraud</option>
            <option id="other" value="other">Other</option>
            <input type="text" id="other_field" name="other_field" placeholder="Please specify" style="display: none;">
            

        </select><br>
        </div>
        <label for="geo_image_tag">Upload a Geotag Image:</label><br>
        <input type="file" accept="image/*" id="imageInput">
        <button type="button" onclick="handleImageUpload()">Upload Image</button>

        <label for="evidence">Upload Evidence:</label><br>
        <input type="file" id="evidence" name="evidence"><br>

        <input type="submit" value="Submit Report">
    </form>
    </body>
<script src="fu.js"></script>
</html>