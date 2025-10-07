<?php
session_start();
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
if(!$username || !$password) $err = 'Isi semua kolom.';
else{
$stmt = $db->prepare('SELECT * FROM users WHERE username = :u LIMIT 1');
$stmt->execute([':u'=>$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if($user && password_verify($password, $user['password'])){
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
header('Location: index.php'); exit;
}else $err = 'Username atau password salah.';
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - Todo</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="display:flex;min-height:100vh;align-items:center;justify-content:center;padding:24px">
<div style="width:420px">
<div class="card">
<h2 style="margin-top:0">Masuk</h2>
<?php if($err): ?><div style="color:#ef4444;margin-bottom:10px"><?php echo htmlspecialchars($err) ?></div><?php endif; ?>
<form method="post">
<div style="margin-bottom:10px"><input class="input" name="username" placeholder="Username"></div>
<div style="margin-bottom:10px"><input class="input" type="password" name="password" placeholder="Password"></div>
<div style="display:flex;gap:8px;justify-content:space-between;align-items:center">
<button class="btn">Login</button>
<a href="register.php" class="small">Belum punya akun? Daftar</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>