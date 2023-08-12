<?php
require 'header.php';  // Assuming session_start() is at the top of header.php

// Check if user is not logged in, then redirect to login page


require 'database.php';

// Delete employee if delete button is clicked
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM Employee WHERE ID = :id");
    $stmt->execute(['id' => $_GET['delete']]);
    // Redirect back to prevent form resubmission
    header("Location: private_details.php");
    exit;
}

// Fetch all employees from the database
$stmt = $pdo->prepare("SELECT * FROM Employee");
$stmt->execute();

$employees = $stmt->fetchAll();
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Employee Details</h2>
        <!-- Add Employee Button -->
        <a href="add_employee.php" class="btn btn-success mb-3">Add Employee</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['ID']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Age']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Salary']); ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?php echo $employee['ID']; ?>" class="btn btn-warning">Edit</a>
                        <a href="private_details.php?delete=<?php echo $employee['ID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-primary mt-3">Logout</a>
    </div>
</div>

<?php
require 'footer.php';
?>
