<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_email    = trim($_POST['email']);
    $new_password = $_POST['password'];


    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $user['PASSWORD'];
    }

    $update_sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $user['id']);

    if ($update_stmt->execute()) {
        $_SESSION['username'] = $new_username; 
        echo "<p style='color:green;'> Profile updated successfully!</p>";
        $user['username'] = $new_username;
        $user['email']    = $new_email;
        $user['password'] = $hashed_password;
    } else {
        echo "<p style='color:red;'> Error updating profile.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2f3640;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #2f3640;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dcdde1;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background: #0097e6;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: #40739e;
        }
        .logout {
            margin-top: 15px;
            text-align: center;
        }
        .logout a {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>👤 Your Profile</h2>
        <form method="post" action="">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Password (leave empty to keep current)</label>
            <input type="password" name="password">

            <input type="submit" value="Update Profile">
        </form>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>


</html>
