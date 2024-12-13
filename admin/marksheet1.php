<?php
include('connection.php');
session_start();
error_reporting(0);

$se_admin = $_SESSION['admin'];
if ($se_admin == false) {
    header('location:login1.php');
}

if (isset($_POST['submit'])) {
    $stud_id = $_POST['selectname'];
    $grade = $_POST['selectgrade'];
    $term = $_POST['selectsem'];
    $sub1 = $_POST['sub1'];  // Math/Social
    $sub2 = $_POST['sub2'];  // Physics/Account
    $sub3 = $_POST['sub3'];  // Chemistry/Economics
    $sub4 = $_POST['sub4'];  // Computer/Biology
    $sub5 = $_POST['sub5'];  // English
    $sub6 = $_POST['sub6'];  // Nepali

    $total = $sub1 + $sub2 + $sub3 + $sub4 + $sub5 + $sub6;
    $percentage = ($total / 600) * 100;

    if ($percentage >= 60) {
        $class = "First Class";
        $result = "Pass";
    } else if ($percentage >= 50) {
        $class = "Second Class";
        $result = "Pass";
    } else {
        $class = "Fail";
        $result = "Fail";
    }

    $query = "INSERT INTO `result` (stud_id, grade, term, math_social, physics_account, chemistry_economics, computer_biology, english, nepali, total, percentage, class, result) 
              VALUES ('$stud_id', '$grade', '$term', '$sub1', '$sub2', '$sub3', '$sub4', '$sub5', '$sub6', '$total', '$percentage', '$class', '$result')";

    if (mysqli_query($con, $query)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<html>
<head>
    <title>Marksheet</title>
   <link rel="stylesheet" href="css/marksheetstyle.css">
</head>
<body>
    <?php include('header1.php'); ?>
    <br>
    <form action="" method="POST">
        <center>
            <div>
                <table class="tab" border="2" bgcolor="white" cellspacing="5px">
                    <tr>
                        <th colspan="2" align="center">Enter Student Marks</th>
                    </tr>
                    <?php
                    $query1 = "SELECT * FROM `student_register`";
                    $m = mysqli_query($con, $query1);
                    ?>
                    <tr>
                        <td>Student Name:</td>
                        <td>
                            <select name="selectname" required>
                                <option value="">--Select Name--</option>
                                <?php while ($row = mysqli_fetch_array($m)) { ?>
                                    <option value="<?php echo $row['stud_id']; ?>"><?php echo $row['sname']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Grade:</td>
                        <td>
                            <select name="selectgrade" required>
                                <option value="">--Select Grade--</option>
                                <option value="11 Science">11 Science</option>
                                <option value="11 Management">11 Management</option>
                                <option value="12 Science">12 Science</option>
                                <option value="12 Management">12 Management</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Term:</td>
                        <td>
                            <select name="selectsem" required>
                                <option value="">--Select Term--</option>
                                <option value="Term 1">Term 1</option>
                                <option value="Term 2">Term 2</option>
                                <option value="Term 3">Term 3</option>
                                <option value="Term 4">Term 4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Math/Social:</td>
                        <td><input type="number" name="sub1" required></td>
                    </tr>
                    <tr>
                        <td>Physics/Account:</td>
                        <td><input type="number" name="sub2" required></td>
                    </tr>
                    <tr>
                        <td>Chemistry/Economics:</td>
                        <td><input type="number" name="sub3" required></td>
                    </tr>
                    <tr>
                        <td>Computer/Biology:</td>
                        <td><input type="number" name="sub4" required></td>
                    </tr>
                    <tr>
                        <td>English:</td>
                        <td><input type="number" name="sub5" required></td>
                    </tr>
                    <tr>
                        <td>Nepali:</td>
                        <td><input type="number" name="sub6" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Save Marks">
                        </td>
                    </tr>
                </table>
            </div>
        </center>
    </form>
    <div class="container">
        <div class="header">
        <button class="print-button" onclick="window.print()">Print</button>
        </div>
    <br>
    <div class="table-container">
    <table class="result-table" style="margin:0 auto;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Grade</th>
            <th>Term</th>
            <th>Math/Social</th>
            <th>Physics/Account</th>
            <th>Chemistry/Economics</th>
            <th>Computer/Biology</th>
            <th>English</th>
            <th>Nepali</th>
            <th>Total</th>
            <th>Percentage</th>
            <th>Class</th>
            <th>Result</th>
        </tr>
        <?php
        $query1 = "SELECT r.*, s.sname FROM `result` r JOIN `student_register` s ON r.stud_id = s.stud_id";
        $m = mysqli_query($con, $query1);
        while ($row = mysqli_fetch_array($m)) {
        ?>
            <tr>
                <td><?php echo $row['stud_id']; ?></td>
                <td><?php echo $row['sname']; ?></td>
                <td><?php echo $row['grade']; ?></td>
                <td><?php echo $row['term']; ?></td>
                <td><?php echo $row['math_social']; ?></td>
                <td><?php echo $row['physics_account']; ?></td>
                <td><?php echo $row['chemistry_economics']; ?></td>
                <td><?php echo $row['computer_biology']; ?></td>
                <td><?php echo $row['english']; ?></td>
                <td><?php echo $row['nepali']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['percentage']; ?>%</td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['result']; ?></td>
            </tr>
        <?php } ?>
        </table>
        </div>
   
</body>
</html>
