<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profil - ToDo App</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="sidebar">
    <div class="sidebar-top">
      <h3>📝 ToDo App</h3>
      <div class="menu">
        <a href="home.php">🏠 Home</a>
        <a href="profile.php" class="active">👤 Profil</a>
      </div>
    </div>
    <div class="sidebar-bottom">
      <a href="logout.php">🚪 Logout</a>
    </div>
  </div>

  <div class="content">
    <h2>Profil Pengguna</h2>
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
  </div>
</body>
</html>
