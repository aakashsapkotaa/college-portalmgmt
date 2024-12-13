<?php 
include("connection.php");
include("header1.php");
$select_query = "SELECT * FROM student_register WHERE stud_id=?";
$stmt = $con->prepare($select_query);
$stmt->bind_param("i", $_GET["editid"]);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/editstudent.css">
</head>
<body>
    <form action="editstudent.php?editid=<?php echo $row['stud_id']; ?>" method="POST">
        <center>
        <div class="container">
            <table bgcolor="#ffffff" width=95% align="center" cellspacing=10>
                <tr><td colspan=2><h2>&nbsp;&nbsp;&nbsp;Edit Student Result</h2><hr></td></tr>
                <tr><td>Name</td><td><input type="text" name="name" value="<?php echo $row['sname']; ?>"></td></tr>
                <tr>
                    <td>Grade</td>
                    <td>
                        <select name="grade">
                            <option value="11 Science" <?php if($row["sgrade"]=='11 Science'){echo "selected";}?>>11 Science</option>
                            <option value="11 Management" <?php if($row["sgrade"]=='11 Management'){echo "selected";}?>>11 Management</option>
                            <option value="12 Science" <?php if($row["sgrade"]=='12 Science'){echo "selected";}?>>12 Science</option>
                            <option value="12 Management" <?php if($row["sgrade"]=='12 Management'){echo "selected";}?>>12 Management</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Email</td><td><input type="text" name="email" value="<?php echo $row['semail']; ?>"></td></tr>
                <tr><td>Contact</td><td><input type="text" name="contact" value="<?php echo $row['scontact']; ?>"></td></tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input value="male" type="radio" name="gender" <?php if($row['sgender']=="male"){echo "checked";}?>>Male
                        <input value="female" type="radio" name="gender" <?php if($row['sgender']=="female"){echo "checked";}?>>Female
                    </td>
                </tr>
                <tr><td colspan=2><hr></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" name="btnupdate" value="Update Student" class="btn"></td></tr>
            </table>
        </center>
    </form>
    </div>
</body>
</html> 

<?php 
if(isset($_POST['btnupdate'])) {
    $id = $_GET["editid"];
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];

    $query = "UPDATE student_register SET sname=?, sgrade=?, semail=?, scontact=?, sgender=? WHERE stud_id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssssi", $name, $grade, $email, $contact, $gender, $id);

    if($stmt->execute()) {
        echo"<script>alert('Student Record Updated Successfully!');</script>";
        echo"<script>location.replace('registration1.php');</script>";
    } else {
        echo '<script>alert("Error in record update: ' . $con->error . '");</script>';
    }
}
?>
