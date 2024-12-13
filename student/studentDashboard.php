<?php
include("header2.php");
include("connection1.php");
session_start();

// Ensure the student is logged in
if (!isset($_SESSION['studentlogin'])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <link rel="stylesheet" href="css/studentDashboard.css">
</head>
<body>
    <div class="container">
        <div class="header">
            Student Result
            <button class="print-button" onclick="window.print()">Print</button>
        </div>
        <?php
        // Query to fetch student and result data
        $query = "SELECT * FROM student_register INNER JOIN result ON 
                  student_register.stud_id = result.stud_id WHERE student_register.semail = '" . $_SESSION['studentlogin'] . "'";

        $query_run1 = mysqli_query($con, $query);
        $result_found = false;

        // Fetch result data if found
        while ($row = mysqli_fetch_assoc($query_run1)) {
            $result_found = true;
            $id = $row['stud_id'];
            $name = $row['sname'];
            $grade = $row['sgrade'];
            $sem = $row['term'];
            $sub1 = $row['math_social'];
            $sub2 = $row['physics_account'];
            $sub3 = $row['chemistry_economics'];
            $sub4 = $row['computer_biology'];
            $sub5 = $row['english'];
            $total = $row['total'];
            $percentage = $row['percentage'];
            $class = $row['class'];
            $result = $row['result'];
        }

        // If no result found, display message
        if (!$result_found) {
            echo "<center><font size='5px'>No Result Found</font></center>";
            exit();
        }
        ?>

        <table class="result-table">
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
                <th>Total Marks</th>
                <th>Percentage</th>
                <th>Class</th>
                <th>Result</th>
            </tr>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $grade ?></td>
                <td><?php echo $sem ?></td>
                <td><?php echo $sub1 ?></td>
                <td><?php echo $sub2 ?></td>
                <td><?php echo $sub3 ?></td>
                <td><?php echo $sub4 ?></td>
                <td><?php echo $sub5 ?></td>
                <td><?php echo $total ?>/500</td>
                <td><?php echo $percentage ?>%</td>
                <td><?php echo $class ?></td>
                <td><?php echo $result ?></td>
            </tr>
        </table>

        <div class="footer">
            <p>For any issues or clarifications, please contact the student support.</p>
        </div>
    </div>
</body>
</html>
