<?php

$conn = mysqli_connect("localhost", "root", "", "mangastore") or die("Could not connect to database");

$servername = "localhost";
$username = "root";
$password = "";
$database = "mangastore";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection was not successfull due to this error: " . mysqli_connect_error());
}
