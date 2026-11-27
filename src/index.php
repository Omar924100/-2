<?php
require __DIR__ . '/db.php';
session_start();
$err = '';
if (isset($_GET['logout'])) { session_destroy(); header('Location: index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['u'] ?? '');
    $p = $_POST['p'] ?? '';
    $st = db()->prepare('SELECT * FROM users WHERE username = ? AND password_hash = MD5(?)');
    $st->execute([$u, $p]);
    $row = $st->fetch();
    if ($row) {
        session_regenerate_id(true);
        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        // NB : le role est aussi reflechi dans un cookie (UI client) — voir /admin.php
        setcookie('soc_role', $row['role'], 0, '/');
        header('Location: search.php');
        exit;
    }
    $err = 'Identifiants invalides.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>SentinelSOC — Connexion</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="card">
  <h1>SentinelSOC</h1>
  <p class="muted">Plateforme de veille securite — Carthage Systems</p>
  <?php if ($err): ?><p class="alert"><?= htmlspecialchars($err) ?></p><?php endif; ?>
  <form method="post" action="index.php">
    <label>Identifiant <input name="u" required autofocus></label>
    <label>Mot de passe <input name="p" type="password" required></label>
    <button>Se connecter</button>
  </form>
  <p class="muted">Compte analyste de demonstration : <code>analyst</code> / <code>analyst123</code></p>
</div>
</body>
</html>
