<?php
require 'header.php';  // Assuming session_start() is at the top of header.php
require 'database.php';

// Check if user is not logged in, then redirect to login page


// Handle form submission and insert the new employee into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $stmt = $pdo->prepare("INSERT INTO Employee (Name, Age, Salary) VALUES (:name, :age, :salary)");
    $stmt->execute(['name' => $name, 'age' => $age, 'salary' => $salary]);

    // Redirect to private_details.php after adding the employee
    header("Location: private_details.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Add New Employee</h2>
        <form action="add_employee.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
</div>

<?php
require 'footer.php';
?>
