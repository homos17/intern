<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
            background: #273c75;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background: #192a56;
        }
        .form-container .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .form-container .register-link a {
            color: #4cd137;
            text-decoration: none;
            font-weight: bold;
        }
        .form-container .register-link a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>


<body>
    <div class="form-container">
        <h2>Login</h2>

        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</body>


<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = ?";
    $req = $conn->prepare($sql);
    $req->bind_param("s", $username);
    $req->execute();
    $res = $req->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();

        if (password_verify($password, $user['PASSWORD'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: profile.php"); 
            exit;
        }
    } else {
        $_SESSION['error'] = "User not found!";
        header("Location: login.php");
        exit;
    }

    $req->close();
    $conn->close();
}
?>
</html>
