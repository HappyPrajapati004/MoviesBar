<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
      rel="stylesheet" />
</head>
<body>
    <div class="fcontainer">
    <div class="form-container">
        <p class="title">Login</p>
        <form class="form" action="" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" required name="username" id="username" placeholder="">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" required name="password" id="password" placeholder="">
            </div><br>
            <button class="sign" type="submit" >Log in</button>
        </form>
        <br>
        <p class="signup">Don't have an account?
            <a href="sign up.php" class="">Sign up</a>
        </p>
    </div>
<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM user_details WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
            if($username = "Admin" && $password = "Admin@123"){
                header("Location: admin.php");
            }
        // Verify password using password_verify()
        if (password_verify($password, $storedPassword)) {
            // User found, set session variables and redirect to welcome page
            $_SESSION["username"] = $username;
            header("Location: home.php");
        } else {
            // Incorrect password
            echo "<script type='text/javascript'>alert('Invalid username or password!');
            window.location.href = 'login.php';
            </script>";
        }
    } else {
        // User not found
        echo "<script type='text/javascript'>alert('First enter username or password!');
        history.replaceState(null, null, 'login.php');
        window.location.href = 'login.php';
         </script>";
    }

    $stmt->close();
}

$conn->close();
?>
    </div>
</body>
</html>