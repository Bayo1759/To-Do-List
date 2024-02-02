<?php
$dbHost = 'localhost'; // Replace with your actual database host
$dbUser = ''; // Replace with your actual database user
$dbPassword = ''; // Replace with your actual database password
$dbName = 'todo_database'; // Replace with your actual database name

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and display form submissions
$sql = "SELECT DATE, GROUP_CONCAT(DISTINCT staff_name ORDER BY staff_name SEPARATOR ', ') AS names
        FROM todo_submissions
        GROUP BY DATE";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['DATE']}: {$row['names']}</p>";
    }
} else {
    echo "No submissions found.";
}

$conn->close();
?>
