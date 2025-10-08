<?php
include 'config.php';

if (isset($_SESSION['user_id'])) header("Location: home.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username='$username'");
  if (mysqli_num_rows($check) > 0) {
    $error = "⚠️ Username atau email sudah digunakan!";
  } else {
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
      exit;
    } else {
      $error = "⚠️ Gagal mendaftar!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar - ToDo App</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-body">
  <div class="auth-container">
    <div class="auth-box">
      <h2>Buat Akun ✨</h2>
      <p class="subtitle">Daftar untuk mulai menggunakan ToDo App</p>

      <?php if(isset($error)) echo "<div class='error-box'>$error</div>"; ?>

      <form method="POST">
        <div class="form-group">
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">Daftar</button>
      </form>

      <p class="bottom-text">Sudah punya akun? <a href="index.php">Masuk</a></p>
    </div>
  </div>
</body>
</html>
