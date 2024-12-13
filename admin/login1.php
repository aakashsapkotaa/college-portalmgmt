<?php
if(isset($_POST['submit'])){
    $username = $_POST['username1'];
    $password = $_POST['password1'];

    if($username == "oxford" && $password == "oxford"){
        session_start();
        $_SESSION["admin"] = $username;
        header('location:index1.php');
    } else {
        header("location:login1.php");   
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login1.css">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username1" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password1" required>
            </div>

            <input type="submit" name="submit" value="LOGIN">
        </form>
    </div>

</body>
</html>
