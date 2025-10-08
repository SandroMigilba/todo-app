<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM todos WHERE id=$id AND user_id=" . $_SESSION['user_id']);
header("Location: home.php");
?>
