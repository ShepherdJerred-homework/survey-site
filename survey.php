<?php

if ($_POST["input-source"] != "Secret Survey") {
    echo "<h1>Invalid survey source!</h1>";
    return;
}

if ($_POST["name"] == null)
    $name = "Not specified";
else
    $name = $_POST["name"];

if ($_POST["gender"] == "M")
    $gender = "Male";
else
    $gender = "Female";

echo "<h1>Thank You!</h1>";

echo "Name: <strong>" . $name . "</strong><br>";
echo "Classification: <strong>" . $_POST["class"] . "</strong><br>";
echo "Gender: <strong>" . $gender . "</strong><br>";
echo "Email: <a href='mailto:" . $_POST["email"] . "'>" . $_POST["email"] . "</a><br>";
echo "Password: <strong>" . $_POST["pword"] . "</strong><br>";

echo "Favorite Classes: ";
if (empty($_POST["classes"]))
    echo "None selected<br>";
else {
    echo "<ul>";
    foreach ($_POST["classes"] as $class) {
        echo "<li>";
        switch ($class) {
            case "class-web":
                echo "Web Development";
                break;
            case "class-net":
                echo "Networking";
                break;
            case "class-gui":
                echo "GUI";
                break;
            case "class-oop":
                echo "OOP";
                break;
        }
        echo "</li>";
    }
    echo "</ul>";
}

echo "Spring Graduation: <strong>" . $_POST["grad"] . "</strong><br>";
echo "Comments: <strong>" . $_POST["comments"] . "</strong><br>";