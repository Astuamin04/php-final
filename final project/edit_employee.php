<?php
require 'header.php';
require 'database.php';

// Check if user is not logged in, then redirect to login page


// Fetch the employee details if an ID is provided
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM Employee WHERE ID = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $employee = $stmt->fetch();
}

// Handle form submission and update the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];

    $stmt = $pdo->prepare("UPDATE Employee SET Name = :name, Age = :age, Salary = :salary WHERE ID = :id");
    $stmt->execute(['name' => $name, 'age' => $age, 'salary' => $salary, 'id' => $id]);

    header("Location: private_details.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Edit Employee</h2>
        <?php if (isset($employee)): ?>
        <form action="edit_employee.php" method="post">
            <input type="hidden" name="id" value="<?php echo $employee['ID']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($employee['Name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($employee['Age']); ?>" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['Salary']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php else: ?>
        <p>Employee not found.</p>
        <?php endif; ?>
    </div>
</div>

<?php
require 'footer.php';
?>
