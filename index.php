<?php
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }

require 'db.php'; // koneksi MySQL

$user_id = (int)$_SESSION['user_id'];

// Siapkan dan jalankan query
$stmt = $db->prepare('SELECT * FROM tasks WHERE user_id = :uid ORDER BY created_at DESC');
$stmt->execute([':uid'=>$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard - Todo</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<aside class="sidebar">
<div class="logo">Todo<span style="color:#0077e6">App</span></div>
<ul class="nav">
<li><a href="index.php" class="active">Dashboard</a></li>
<li><a href="#">Tasks</a></li>
<li><a href="#">Profile</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
<div style="margin-top:18px" class="small">Signed in as <strong><?php echo htmlspecialchars($_SESSION['username']) ?></strong></div>
</aside>
<main class="main">
<div class="header">
<div>
<div class="h1">My Tasks</div>
<div class="small">Manage your daily to-dos</div>
</div>
<div class="profile">
<div class="avatar"><?php echo strtoupper(substr($_SESSION['username'],0,1)) ?></div>
</div>
</div>


<div class="card">
<form class="form" action="add_task.php" method="post">
<input class="input" name="title" placeholder="Tambah tugas baru..." required>
<button class="btn">Tambah</button>
</form>
</div>


<div style="height:18px"></div>


<?php if(!$tasks): ?>
<div class="card"><div class="small">Belum ada tugas. Tambah tugas untuk memulai.</div></div>
<?php else: ?>
<?php foreach($tasks as $t): ?>
<div class="task card">
<div>
<div style="font-weight:600"><?php echo htmlspecialchars($t['title']) ?></div>
<div class="meta"><?php echo date('d M Y H:i', strtotime($t['created_at'])) ?></div>
</div>
<div style="display:flex;gap:8px;align-items:center">
<?php if($t['is_done']): ?>
<span class="badge">Done</span>
<?php else: ?>
<a href="edit_task.php?id=<?php echo $t['id'] ?>" class="small">Edit</a>
<?php endif; ?>
<a href="delete_task.php?id=<?php echo $t['id'] ?>" class="small">Hapus</a>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>


</main>
</div>
</body>
</html>