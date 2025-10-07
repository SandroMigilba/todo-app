<?php
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = (int)$_SESSION['user_id'];
$id = (int)($_GET['id'] ?? 0);
if($id){
$stmt = $db->prepare('DELETE FROM tasks WHERE id=:id AND user_id=:uid');
$stmt->execute([':id'=>$id, ':uid'=>$user_id]);
}
header('Location: index.php'); exit;