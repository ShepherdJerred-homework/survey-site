<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {

    $db = new mysqli("taz.harding.edu", "jshepherd", "H01599828", "jshepherd");
    $insert = false;

    if ($db->connect_errno)
        die("Failed to connect to MySQL: ($db->connect_errno) $db->connect_error");

    if (!empty($_POST['id'])
        && !empty($_POST['dept'])
        && !empty($_POST['num'])
        && !empty($_POST['title'])
        && !empty($_POST['instructor'])
        && ctype_digit($_POST['id'])
        && ctype_digit($_POST['num'])
    ) {
        $ps = $db->prepare("INSERT IGNORE INTO courses VALUES (?, ?, ?, ?, ?)");

        $id = intval($_POST['id']);
        $num = intval($_POST['num']);

        $ps->bind_param(
            "isiss",
            $id,
            $_POST['dept'],
            $num,
            $_POST['title'],
            $_POST['instructor']
        );
        $ps->execute();
        $insert = true;
    }

    $ps = $db->prepare("SELECT * FROM courses ORDER BY dept, num");
    $ps->execute();
    $result = $ps->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
</head>

<body>
<?php if ($method === "GET"): ?>
    <h1>New Course</h1>
    <p>Enter a new course:</p>
    <form method="POST" action="courses.php">
        <div>
            <label>
                ID:
                <input type="text" name="id">
            </label>
        </div>
        <div>
            <label>
                Dept:
                <input type="text" name="dept">
            </label>
        </div>
        <div>
            <label>
                Num:
                <input type="text" name="num">
            </label>
        </div>
        <div>
            <label>
                Title:
                <input type="text" name="title">
            </label>
        </div>
        <div>
            <label>
                Instructor:
                <input type="text" name="instructor">
            </label>
        </div>
        <br>
        <button>Save</button>
    </form>
<?php elseif ($method === "POST"): ?>
    <h1>All Courses</h1>
    <?php if ($insert): ?>
        <p>Inserted new course.</p>
    <?php endif; ?>
    <table border="1">
        <thead>
        <tr>
            <td><strong>Course ID</strong></td>
            <td><strong>Dept</strong></td>
            <td><strong>Number</strong></td>
            <td><strong>Title</strong></td>
            <td><strong>Instructor</strong></td>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['courseid'] . "</td>";
            echo "<td>" . $row['dept'] . "</td>";
            echo "<td>" . $row['num'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['instructor'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <p>
        <a href="courses.php">Insert more courses</a>.
    </p>
<?php endif; ?>
</body>

</html>