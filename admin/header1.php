<?php
session_start();
error_reporting(0);
$se_admin = $_SESSION['admin'];
if ($se_admin == false) {
    header('location:login1.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/header1.css">
</head>
<body>
    <nav>
        <a href="header1.php" class="logo">Admin Dashboard</a>
        <ul>
            <li><a href="registration1.php">Student Registration</a></li>
            <li><a href="marksheet1.php">Student Marksheet</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="username">Username: <?php echo $se_admin; ?></div>
</body>
</html>
