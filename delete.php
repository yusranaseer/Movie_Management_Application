<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'movie_management';
$conn = mysqli_connect('localhost', 'root', '', 'movie_management') or die('connection failed');

$id = $_GET['delete'];

mysqli_query($conn, "DELETE FROM movie WHERE id = '$id'");
header('location:index.php');

?>
