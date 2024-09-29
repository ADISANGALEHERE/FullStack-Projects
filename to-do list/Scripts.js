// Add an event listener to the "Add Task" button
document.getElementById('addButton').addEventListener('click', addTask);

// Function to add a new task
function addTask() {
    // Get the input value and remove extra spaces
    const taskInput = document.getElementById('taskInput');
    const taskText = taskInput.value.trim();

    // If the input is empty, do nothing
    if (taskText === '') return;

    // Get the task list element
    const taskList = document.getElementById('taskList');
    // Create a new list item
    const li = document.createElement('li');

    // Set the text of the list item to the task
    li.textContent = taskText;
    // Add an event listener to toggle completion when clicked
    li.addEventListener('click', () => {
        li.classList.toggle('completed'); // Toggles the 'completed' class
    });

    // Create a delete button
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'X'; // Sets the button text to 'X'
    deleteButton.classList.add('delete'); // Adds a class for styling

    // Add an event listener to delete the task when clicked
    deleteButton.addEventListener('click', () => {
        taskList.removeChild(li); // Removes the list item from the task list
    });

    // Append the delete button to the list item
    li.appendChild(deleteButton);
    // Append the list item to the task list
    taskList.appendChild(li);
    // Clear the input field
    taskInput.value = '';
}
