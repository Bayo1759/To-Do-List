// Function to add to-do
function addTodo() {
    const form = document.getElementById('todoForm');
    const todoList = document.getElementById('todoList'); 

    // Validate the deadline (set to 10:00 AM)
    const deadline = new Date(`${form.date.value}T${form.time.value}`);
    const tenAM = new Date(`${form.date.value}T10:00:00`);

    if (deadline > tenAM) {
        alert('The deadline for submission is 10:00 AM.');
        return;
    }

    // Update the count only if the submission is before the deadline
    updateCount();

    // Create a new list item
    const li = document.createElement('li');
    li.className = 'bg-white p-4 mb-4 rounded shadow-md';

    // Populate the list item with form data
    li.innerHTML = `
        <strong>Staff Name:</strong> ${form.staffName.value}<br>
        <strong>Date:</strong> ${form.date.value}<br>
        <strong>Department:</strong> ${form.department.value}<br>
        <strong>Staff ID:</strong> ${form.staffId.value}<br>
        <strong>To-Do:</strong> ${form.todo.value}<br>
        <strong>Report:</strong> ${form.report.value}<br>
        <strong>Time</strong> ${form.time.value}
    `;

    // Append the list item to the todoList
    todoList.appendChild(li);

    // Clear the form fields
    form.reset();
}

// Function to update the count
function updateCount() {
    // Get the current time
    const currentTime = new Date();

    // Get the count element
    const countElement = document.getElementById('countDisplay');

    // Check if the current time is before 10:00 AM
    const isBeforeTenAM = currentTime.getHours() < 10;

    // Increment the count only if it's before 10:00 AM
    if (isBeforeTenAM) {
        count++;
    }

    // Update the count display
    countElement.innerHTML = `Number of entries today: ${count}`;
}

// Initialize count
let count = 0;
