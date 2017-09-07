<?php
$results = fopen("results.txt", "r") or
die("Can't open results.txt for reading");

$males = [];
$females = [];
$total = [];

while (!feof($results)) {
    // Read a line like this: "class-gui M\n"
    $line = fgets($results);

    // Account for a blank line at the end of the file
    if (strlen($line) > 1) {
        $class = substr($line, 0, 9);
        $gender = substr($line, 10, 1);
        if ($gender == "M") {
            $males[$class] += 1;
        } else {
            $females[$class] += 1;
        }
        $total[$class] += 1;
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Results</title>
</head>

<body>
<table border="1">
    <thead>
    <tr>
        <td><b>Class</b></td>
        <td><b>Males</b></td>
        <td><b>Females</b></td>
        <td><b>Total</b></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Web Development</td>
        <td><?php echo $males["class-web"] ?></td>
        <td><?php echo $females["class-web"] ?></td>
        <td><?php echo $total["class-web"] ?></td>
    </tr>
    <tr>
        <td>Networking</td>
        <td><?php echo $males["class-net"] ?></td>
        <td><?php echo $females["class-net"] ?></td>
        <td><?php echo $total["class-net"] ?></td>
    </tr>
    <tr>
        <td>GUI</td>
        <td><?php echo $males["class-gui"] ?></td>
        <td><?php echo $females["class-gui"] ?></td>
        <td><?php echo $total["class-gui"] ?></td>
    </tr>
    <tr>
        <td>OOP</td>
        <td><?php echo $males["class-oop"] ?></td>
        <td><?php echo $females["class-oop"] ?></td>
        <td><?php echo $total["class-oop"] ?></td>
    </tr>
    </tbody>
</table>
</body>
</html>