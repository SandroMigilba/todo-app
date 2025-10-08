<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM todos WHERE user_id=$user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Home - ToDo App</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-top">
      <h3>📝 ToDo App</h3>
      <div class="menu">
        <a href="home.php" class="active">🏠 Home</a>
        <a href="profile.php">👤 Profil</a>
      </div>
    </div>
    <div class="sidebar-bottom">
      <a href="logout.php">🚪 Logout</a>
    </div>
  </div>

  <!-- Konten Utama -->
  <div class="content" id="content">
    <div class="toggle-btn-hide">
      <button class="toggle-btn" onclick="toggleSidebar()">
        <img src="img/icon-menu.png" alt="" style="width: 30px">
      </button>
      <h2>Halo, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    </div>

    <!-- <div class= todo-form-wrap> -->
    <form action="add_todo.php" method="POST" class="todo-form">
      <input type="text" name="task" placeholder="Tambah tugas baru..." required>
      <button type="submit">Tambah</button>
    </form>
    <!-- </div> -->

    <ul class="todo-list">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <li class="<?= $row['status'] ? 'done' : '' ?>">
          <form action="update_todo.php" method="POST" class="edit-form">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="task" value="<?= htmlspecialchars($row['task']) ?>" readonly>
            <div class="actions">
              <!-- Tombol Done / Undo -->
              <?php if ($row['status'] == 0): ?>
                <a href="toggle_status.php?id=<?= $row['id'] ?>&status=1" class="done-btn">✅</a>
              <?php else: ?>
                <a href="toggle_status.php?id=<?= $row['id'] ?>&status=0" class="undo-btn">↩️</a>
              <?php endif; ?>

              <button type="button" class="edit-btn">✏️</button>
              <button type="submit" class="save-btn" style="display:none;">💾</button>
              <a href="delete_todo.php?id=<?= $row['id'] ?>" class="delete-btn">❌</a>
            </div>
          </form>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>

  <script>
    // JS untuk tombol edit
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const form = btn.closest('.edit-form');
        const input = form.querySelector('input[name="task"]');
        const saveBtn = form.querySelector('.save-btn');
        
        if (input.readOnly) {
          input.readOnly = false;
          input.focus();
          input.style.border = "1px solid #00a8e8";
          btn.style.display = "none";
          saveBtn.style.display = "inline-block";
        }
      });
    });
  </script>

  <script src="assets/script.js"></script>
</body>
</html>
