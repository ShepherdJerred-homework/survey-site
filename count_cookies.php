<?php
$views = 0;

if (isset($_COOKIE["views"]))
    $views += $_COOKIE["views"] + 1;
else
    $views = 1;

setcookie("views", $views);
echo $views;