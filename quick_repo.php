<?php

include 'connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the image file is uploaded
    if (isset($_FILES["imageInput1"]) && $_FILES["imageInput1"]["error"] == 0) {
        $targetDirectory = "uploads/"; // Specify the directory where you want to store uploaded images
        $targetFile = $targetDirectory . basename($_FILES["imageInput1"]["name"]);
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["imageInput1"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully, now you can store the file path in the database
            $imagePath = $targetFile;

            // Retrieve other form data
            $report = $_POST["report"];

        
            // Prepare SQL statement to insert data
            $stmt = $conn->prepare("INSERT INTO reports (report, imagePath) VALUES (?, ?)");
            $stmt->bindValue("ss", $report, $imagePath);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "Report submitted successfully.";
            } else {
                echo "Error: " . $errorInfo[2];

            }

            // Close statement and connection
        
           
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Please select an image.";
    }
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
        <button onclick="quickForms(quick_repo.php)">Quick Report</button>
        <button onclick="detailedForms(detailed_repo.php)">Detailed Report</button>
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
    </div>
    <form action="submit_report.php" method="post" enctype="multipart/form-data" class="quick-form">
        
        <label for="imagePath">Upload a Geotag Image:</label><br>
        <input type="file" accept="image/*" id="imageInput1">
        <button type="button" onclick="handleImageUpload1()">Upload Image</button>

        <label for="report">A one line Report about the incident</label><br>
        <input type="text" id="report" name="report"><br>

        <input type="submit" value="Submit Report">
    </form>
</div>
</body>
<script src="fu.js"></script>
</html>