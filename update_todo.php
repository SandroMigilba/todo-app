<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$id = $_POST['id'];
$task = $_POST['task'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "UPDATE todos SET task='$task' WHERE id=$id AND user_id=$user_id");
header("Location: home.php");
exit;
?>
