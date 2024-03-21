<?php
include('connect.php');

$stmt = $conn->prepare("SELECT * FROM manga Limit 4");

$stmt->execute();
$featured_manga=$stmt->get_result();

?>