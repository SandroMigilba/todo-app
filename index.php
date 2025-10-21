<?ph
include 'config.php';

if (isset($_SESSION['user_id'])) header("Location: home.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username_email = $_POST['username_email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header("Location: home.php");
      exit;
    } else {
      $error = "⚠️ Password salah!";
    }
  } else {
    $error = "⚠️ Username atau email tidak ditemukan!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - ToDo App</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-body">
  <div class="auth-container">
    <div class="auth-box">
      <h2>Selamat Datang 👋</h2>
      <p class="subtitle">Masuk ke akun ToDo App kamu</p>

      <?php if(isset($error)) echo "<div class='error-box'>$error</div>"; ?>

      <form method="POST">
        <div class="form-group">
          <input type="text" name="username_email" placeholder="Username atau Email" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">Masuk</button>
      </form>

      <p class="bottom-text">Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
  </div>
</body>
</html>



