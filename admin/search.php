<?php
include('header1.php');
include('connection.php');
?>

<html>

<head>
    <title>Search</title>
    <link rel="stylesheet" href="css/search.css">
</head>

<body bgcolor="#B3B6B7">
    <form action="" method="POST">
        <center>
            <table border="1" height="40%" width="40%" bgcolor="white" style="border-collapse: collapse;">
                <tr>
                    <th colspan="2">
                        <h1>Search Result</h1>
                    </th>
                </tr>
                <tr align="center">
                    <td>Grade</td>
                    <td>
                        <select name="grade" onchange="this.form.submit();">
                            <option value="">--Select--</option>
                            <option value="11 Science" <?php if (isset($_POST['grade']) && $_POST['grade'] == '11 Science') echo 'selected'; ?>>11 Science</option>
                            <option value="11 Management" <?php if (isset($_POST['grade']) && $_POST['grade'] == '11 Management') echo 'selected'; ?>>11 Management</option>
                            <option value="12 Science" <?php if (isset($_POST['grade']) && $_POST['grade'] == '12 Science') echo 'selected'; ?>>12 Science</option>
                            <option value="12 Management" <?php if (isset($_POST['grade']) && $_POST['grade'] == '12 Management') echo 'selected'; ?>>12 Management</option>
                        </select>
                    </td>
                </tr>
                <tr align="center">
                    <td>Name</td>
                    <td>
                        <select name="name" required>
                            <option value="">--Select--</option>
                            <?php
                            if (isset($_POST['grade']) && $_POST['grade'] != '') {
                                $grade = $_POST['grade'];
                                $sql = mysqli_query($con, "SELECT * FROM student_register WHERE sgrade='$grade'");
                                if ($sql) {
                                    while ($row = mysqli_fetch_array($sql)) {
                                        echo "<option value='" . $row['stud_id'] . "'>" . $row['sname'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No students found for selected grade</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2"><input type="submit" name="btnsearch" value="Search"></td>
                </tr>
            </table>
        </center>
    </form>

    <?php
    if (isset($_POST['btnsearch'])) {
        $grade = $_POST['grade'];
        $name = $_POST['name'];

        if ($grade == '' || $name == '') {
            echo "<center>Please select both grade and student name to search.</center>";
        } else {
            $query = "SELECT * FROM student_register 
                      INNER JOIN result ON student_register.stud_id = result.stud_id 
                      WHERE student_register.stud_id = '$name' AND student_register.sgrade = '$grade'";
            $query_run1 = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run1) > 0) {
                $row = mysqli_fetch_assoc($query_run1);
    ?>
                <br><br>
                <center style="margin: 50px;
    padding: 10px;
    display: block;
    max-width: fit-content;">
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
                            <th>Nepali</th>
                            <th>Total</th>
                            <th>Percentage</th>
                            <th>Class</th>
                            <th>Result</th>
                        </tr>
                        <tr>
                            <td><?php echo $row['stud_id']; ?></td>
                            <td><?php echo $row['sname']; ?></td>
                            <td><?php echo $row['sgrade']; ?></td>
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
                    </table>

                </center>
    <?php
            } else {
                echo "<center>No results found for the selected student.</center>";
            }
        }
    }
    ?>
</body>

</html>