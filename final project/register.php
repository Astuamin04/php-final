<?php
require 'header.php';
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert into database (always use prepared statements!)
    $stmt = $pdo->prepare("INSERT INTO admin (username, email, password) VALUES (:username, :email, :password)");
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

    // Redirect to login.php after successful registration
    header("Location: login.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<?php
require 'footer.php';
?>
