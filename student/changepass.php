<?php
include("header2.php");
include("connection1.php");
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['studentlogin'])) {
    header("location:login.php");
    exit();
}

// Handle form submission
if (isset($_POST['changepw'])) {
    $oldpass = mysqli_real_escape_string($con, $_POST['opwd']);
    $email = $_SESSION['studentlogin'];
    $npassword = mysqli_real_escape_string($con, $_POST['npwd']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpwd']);

    // Check if the old password matches
    $sql = "SELECT spassword FROM student_register WHERE semail='$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['spassword'] === $oldpass) {
            // Check if new password and confirm password match
            if ($npassword === $cpassword) {
                // Update password in the database
                $update = "UPDATE student_register SET spassword='$npassword' WHERE semail='$email'";
                if (mysqli_query($con, $update)) {
                    echo "<script>alert('Password changed successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating password. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('New Password and Confirm Password do not match.');</script>";
            }
        } else {
            echo "<script>alert('Old Password is incorrect.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
  <link rel="stylesheet" href="css/changepass.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Forgot Password</h2>
        </div>
        <form action="" method="POST">
            <table>
                <tr>
                    <th colspan="2">Change Your Password</th>
                </tr>
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="opwd" required placeholder="Enter Old Password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="npwd" required placeholder="Enter New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="cpwd" required placeholder="Enter Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="changepw" value="Change Password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
