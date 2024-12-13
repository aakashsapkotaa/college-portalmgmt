<?php 
  session_start();
  if(isset($_SESSION["studentlogin"])) {
    header("Location:StudentDashboard.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="form-container">
        <h2>Student Login</h2>
        <form action="" method="POST">
            <input type="email" name="email" required placeholder="Enter your email" />
            <input type="password" name="password" required placeholder="Enter your password" />
            <input type="submit" name="btnlogin" value="Login" />
        </form>
    </div>

</body>
</html>

<?php 
include('connection1.php');
if(isset($_POST['btnlogin'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $sql = "SELECT * FROM student_register WHERE semail='$email' and spassword='$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
    if($row > 0) {
        if($row['status'] == 'Active') {
            $_SESSION["studentlogin"] = $_POST['email'];
            header('location:StudentDashboard.php');
        } else {
            echo "<script>alert('Your Account Has Been Disabled.!!!')</script>";
        }
    } else {
        echo "<script>alert('Wrong Credentials OR Error Try Again....')</script>";
    }
}
?>
