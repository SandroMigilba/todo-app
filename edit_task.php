<?php
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = (int)$_SESSION['user_id'];
$id = (int)($_GET['id'] ?? 0);
$stmt = $db->prepare('SELECT * FROM tasks WHERE id=:id AND user_id=:uid');
$stmt->execute([':id'=>$id, ':uid'=>$user_id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$task){ header('Location: index.php'); exit; }


if($_SERVER['REQUEST_METHOD']==='POST'){
$title = trim($_POST['title'] ?? '');
$is_done = isset($_POST['is_done']) ? 1 : 0;
$stmt = $db->prepare('UPDATE tasks SET title=:t, is_done=:d WHERE id=:id AND user_id=:uid');
$stmt->execute([':t'=>$title, ':d'=>$is_done, ':id'=>$id, ':uid'=>$user_id]);
header('Location: index.php'); exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Edit Task</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="display:flex;min-height:100vh;align-items:center;justify-content:center;padding:24px">
<div style="width:640px">
<div class="card">
<h2 style="margin-top:0">Edit Tugas</h2>
<form method="post">
<div style="margin-bottom:10px"><input class="input" name="title" value="<?php echo htmlspecialchars($task['title']) ?>" required></div>
<div style="margin-bottom:12px"><label><input type="checkbox" name="is_done" <?php echo $task['is_done'] ? 'checked' : '' ?>> Selesai</label></div>
<div style="display:flex;gap:8px"><button class="btn">Simpan</button><a href="index.php" class="small">Batal</a></div>
</form>
</div>
</div>
</div>
</body>
</html>