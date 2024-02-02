<?php
// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to add to-do
function addTodo($data) {
    $filePath = 'todos.txt';

    // Sanitize input data
    $staffName = sanitizeInput($data['staffName']);
    $date = sanitizeInput($data['date']);
    $time = sanitizeInput($data['time']);
    $department = sanitizeInput($data['department']);
    $staffId = sanitizeInput($data['staffId']);
    $todo = sanitizeInput($data['todo']);
    $report = sanitizeInput($data['report']);

    // Validate the deadline (set to 10:00 AM)
    $deadline = new DateTime($date . ' ' . $time);
    $tenAM = new DateTime($date . ' 10:00:00');

    if ($deadline > $tenAM) {
        echo json_encode(['success' => false, 'message' => 'The deadline for submission is 10:00 AM.']);
        return;
    }

    // Format data
    $formattedData = "Staff Name: $staffName\nDate: $date\nDepartment: $department\nStaff ID: $staffId\nTo-Do: $todo\nReport: $report\nTime: $time\n\n";

    // Append data to the file
    if (file_put_contents($filePath, $formattedData, FILE_APPEND | LOCK_EX) !== false) {
        echo json_encode(['success' => true, 'message' => 'To-Do added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add To-Do.']);
    }
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $formData = $_POST;

    // Add to-do
    addTodo($formData);
} else {
    // Handle invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
