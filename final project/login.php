<?php
require 'header.php';  // Assuming session_start() is at the top of header.php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by username
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->execute(['username' => $username]);

    $user = $stmt->fetch();

    // Verify password and redirect if successful
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        header("Location: private_details.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password.</div>";
    }
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<?php
require 'footer.php';
?>
