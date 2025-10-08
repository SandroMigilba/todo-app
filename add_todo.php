<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$task = $_POST['task'];
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "INSERT INTO todos (user_id, task) VALUES ($user_id, '$task')");
header("Location: home.php");
?>
