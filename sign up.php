<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
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
        <p class="title">Signup</p>
        <form class="form" action="" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="">
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="">
            </div><br>
            <button class="sign" type="submit" >Sign in</button>
        </form>
        <br>
        <p class="signup">Already have an account?
            <a href="login.php" class="">Log in</a>
        </p>
    </div>
    <?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize inputs
    $username = htmlspecialchars($_POST["username"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (!$email) {
        die("Invalid email format");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute a prepared statement to insert user data
    $stmt = $conn->prepare("INSERT INTO user_details (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // User created successfully, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Error occurred during insertion
        echo "Error creating user.";
    }

    $stmt->close();
}

$conn->close();
?>

    </div>
</body>

</html>