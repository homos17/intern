<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 350px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #2f3640;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #2f3640;
            font-weight: bold;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dcdde1;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .form-container input[type="submit"] {
            background: #4cd137;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background: #44bd32;
        }
        .form-container .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .form-container .login-link a {
            color: #273c75;
            text-decoration: none;
            font-weight: bold;
        }
        .form-container .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Account</h2>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Register">
        </form>
        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $req = $conn->prepare($sql);
    $req->bind_param("sss", $username, $email, $password);

    if ($req->execute()) {
        $_SESSION['message'] = "Registration is ok ";
        header("Location: login.php");
        exit;
    } else {
        echo $conn->error;
    }

    $req->close();
    $conn->close();
}
?>

</html>
