<?php
include("connection.php");
include("header1.php");

if(isset($_POST['btnsave'])){
    $studname = $_POST['studname'];
    $grade = $_POST['selectgrade'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['textgender'];

    // Image upload logic
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

    // Insert student registration data into the database
    $query = "INSERT INTO student_register (sname, sgrade, semail, spassword, scontact, sgender, image, status) 
              VALUES ('$studname', '$grade', '$email', '$pass', '$mobile', '$gender', '$target_file', 'Active')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Student registered successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Handle changing student status (Activate/Deactivate)
if(isset($_GET['Statuss'])){
    $stud_id = $_GET['Statuss'];
    $query = "SELECT status FROM student_register WHERE stud_id = '$stud_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $new_status = ($row['status'] == 'Active') ? 'Inactive' : 'Active';

    $update_query = "UPDATE student_register SET status = '$new_status' WHERE stud_id = '$stud_id'";
    mysqli_query($con, $update_query);
    header("Location: registration1.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/registrationstyling.css">
</head>
<body>
    

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="result-table">
                 <tr>
                        <th colspan="2" align="center">Student Registration</th>
                    </tr>
                
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="studname" required></td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td>
                        <select name="selectgrade" required>
                            <option value="Select">--Select Grade--</option>
                            <option value="11 Science">11 Science</option>
                            <option value="11 Management">11 Management</option>
                            <option value="12 Science">12 Science</option>
                            <option value="12 Management">12 Management</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Email Id:</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pass" required></td>
                </tr>
                <tr>
                    <td>Mobile No:</td>
                    <td><input type="text" name="mobile" required></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="textgender" value="male" required>Male
                        <input type="radio" name="textgender" value="female" required>Female
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="img" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btnsave" value="Save">
                    </td>
                </tr>
            </table>
        </form>
        <div class="container">
        <div class="header">
        <button class="print-button" onclick="window.print()">Print</button>
        </div>
        <br><br>

        <table class="result-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Mobile no</th>
                <th>Gender</th>
                <th>Image</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
            $query1 = "SELECT * FROM student_register";
            $m = mysqli_query($con, $query1);

            while ($row = mysqli_fetch_array($m)) {
            ?>
                <tr>
                    <td><?php echo $row['stud_id']; ?></td>
                    <td><?php echo $row['sname']; ?></td>
                    <td><?php echo $row['sgrade']; ?></td>
                    <td><?php echo $row['semail']; ?></td>
                    <td><?php echo $row['scontact']; ?></td>
                    <td><?php echo $row['sgender']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" height="100px" width="100px"></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a href="editstudent.php?editid=<?php echo $row['stud_id']; ?>">Edit</a></td>
                    <td>
                        <?php if ($row['status'] == 'Active') { ?>
                            <a href="registration1.php?Statuss=<?php echo $row['stud_id']; ?>">Deactivate</a>
                        <?php } else { ?>
                            <a href="registration1.php?Statuss=<?php echo $row['stud_id']; ?>">Activate</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
