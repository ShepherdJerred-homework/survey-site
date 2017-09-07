<!DOCTYPE HTML>
<html>

<head>
    <title>Survey</title>
</head>

<body>

<h2>Thank You</h2>
<p>We appreciate you taking our survey.</p>

<?php

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$gender = isset($_POST['gender']) ? $_POST['gender'] : '?';

$classes = array(
    "class-web" => "Web Development",
    "class-net" => "Networking",
    "class-gui" => "GUI",
    "class-oop" => "OOP");

if (!isset($_POST['classes']))
    echo "<p>You did not select any favorite classes.</p>";
else {
    // Append to results.txt
    // Note: This file must be manually created and given world-write permissions
    // so the apache process has permission to write to it
    $results = fopen("results.txt", "a") or
    die("Can't open results.txt for appending");

    echo "<p>Favorite classes:<br><ol>";
    foreach ($_POST['classes'] as $class) {
        echo "<li>$classes[$class]</li>";
        fwrite($results, "$class $gender\n");
    }
    echo "</ol>";
    fclose($results);
}
?>

See the <a href="results.php">survey results</a>.

</body>
</html>
