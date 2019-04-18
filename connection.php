<?php

$db = mysqli_connect('localhost','root','','experimentalapprovaldb');

if ($db->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


/*
$db = mysqli_connect('CSDM-WEBDEV','1808957','1808957','db1808957_experiment');

if ($db->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
*/
