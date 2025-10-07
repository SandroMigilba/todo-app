<?php
session_start();
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$err = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
if(!$username || !$password) $err = 'Isi semua kolom.';
else{
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare('INSERT INTO users (username,password) VALUES (:u,:p)');
try{
$stmt->execute([':u'=>$username, ':p'=>$hash]);
$_SESSION['user_id'] = $db->lastInsertId();
$_SESSION['username'] = $username;
header('Location: index.php'); exit;
}catch(PDOException $e){
$err = 'Nama pengguna sudah dipakai.';
}
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register - Todo</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="display:flex;min-height:100vh;align-items:center;justify-content:center;padding:24px">
<div style="width:420px">
<div class="card">
<h2 style="margin-top:0">Buat akun</h2>
<?php if($err): ?><div style="color:#c026d3;margin-bottom:10px"><?php echo htmlspecialchars($err) ?></div><?php endif; ?>
<form method="post">
<div style="margin-bottom:10px"><input class="input" name="username" placeholder="Username"></div>
<div style="margin-bottom:10px"><input class="input" type="password" name="password" placeholder="Password"></div>
<div style="display:flex;gap:8px;justify-content:space-between;align-items:center">
<button class="btn">Daftar</button>
<a href="login.php" class="small">Sudah punya akun? Login</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>