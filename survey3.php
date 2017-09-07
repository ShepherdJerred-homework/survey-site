<?php

$gender = isset($_POST['gender']) ? $_POST['gender'] : '?';

$classes = array(
    "class-web" => "Web Development",
    "class-net" => "Networking",
    "class-gui" => "GUI",
    "class-oop" => "OOP");

if (isset($_POST['classes'])) {
    $results = fopen("results.txt", "a") or
    die("Can't open results.txt for appending");

    foreach ($_POST['classes'] as $class)
        fwrite($results, "$class $gender\n");
    fclose($results);
}

echo 'Thank you! See the <a href="results.php">survey results</a>.';