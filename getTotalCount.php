<?php
// Database connection parameters
$host = "your_database_host";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name"; // Replace with your actual database name

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch total count from the database
$sqlTotalCount = "SELECT COUNT(*) AS total FROM todos";
$resultTotalCount = mysqli_query($connection, $sqlTotalCount);
$rowTotalCount = mysqli_fetch_assoc($resultTotalCount);
$totalCount = $rowTotalCount['total'];

// Close the database connection
mysqli_close($connection);

// Send JSON response
$response = array('totalCount' => $totalCount);
echo json_encode($response);
?>
