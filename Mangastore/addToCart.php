<?php
include('dbConnect.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['manga_id'])) {
    $manga_id = $_GET['manga_id'];
    $user_email = $_SESSION['email'];

    // Check if the item is already in the cart
    $checkQuery = "SELECT Quantity FROM Order_Details WHERE Manga_ID = ? AND C_Email = ?";
    // Prepare and execute $checkQuery, then fetch the result.
    // If the item exists, update its quantity. If not, insert a new row.

    // Redirect to cart.php
    header("Location: cart.php");
    exit;
}
