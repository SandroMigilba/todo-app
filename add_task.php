<?php
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($_SERVER['REQUEST_METHOD']==='POST'){
$title = trim($_POST['title'] ?? '');
if($title){
$stmt = $db->prepare('INSERT INTO tasks (user_id,title) VALUES (:uid,:t)');
$stmt->execute([':uid'=>$_SESSION['user_id'], ':t'=>$title]);
}
}
header('Location: index.php'); exit;