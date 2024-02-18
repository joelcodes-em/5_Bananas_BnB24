<!-- dashboard.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investigator Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* style.css */
body {
    font-family: Arial, sans-serif;
    background-image: url(./assets/images/dashboardbg.jpg);
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem;
}

.report-list {
    margin: 3rem;
}

.report-item {
    border: 1px solid #ddd;
    padding: 1rem;
    margin-bottom: 1rem;
}
.reportdiv{
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    margin-top:1rem;
    border-radius: 10px;
}

.reportdiv > h2,p{
    margin-left: 2rem;
}


    </style>
</head>
<body>
    <header>
        <h1>Investigator Dashboard</h1>
    </header>
    <div class="report-list">
        <!-- Reports will be dynamically added here -->
        <div class="reportdiv">
            <h2>Report title:</h2>
            <p>Person:</p>
            <p>corruption_type:</p>
            <p>location:</p>
        </div>
        <div class="reportdiv">
            <h2>Report title:</h2>
            <p>Person:</p>
            <p>corruption_type:</p>
            <p>location:</p>
        </div>
        <div class="reportdiv">
            <h2>Report title:</h2>
            <p>Person:</p>
            <p>corruption_type:</p>
            <p>location:</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<script>
    // script.js
document.addEventListener("DOMContentLoaded", function () {
    // Fetch report data from the PHP script
    fetch("fetch_reports.php")
        .then((response) => response.json())
        .then((data) => {
            const reportList = document.querySelector(".report-list");

            // Create a list of reports
            data.forEach((report) => {
                const reportItem = document.createElement("div");
                reportItem.classList.add("report-item");
                reportItem.innerHTML = `
                    <h2>Report title: ${report.title}</h2>
                    <p>Person:${report.id}</p>
                    <p>corrupiton_type${report.date}</p>
                `;
                reportList.appendChild(reportItem);
            });
        })
        .catch((error) => console.error("Error fetching report data:", error));
});

</script>