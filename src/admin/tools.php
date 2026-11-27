<?php
session_start();
if (empty($_SESSION['user']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die('Session administrateur requise.');
}
$out = '';
$host = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = trim($_POST['host'] ?? '');
    if ($host !== '') {
        // VULNERABILITE (RCE) : injection de commande — la valeur est concatenee
        // a une commande shell sans aucun echappement.
        $out = shell_exec("ping -c 2 -W 1 " . $host . " 2>&1");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>SentinelSOC — Outils</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="card wide">
  <h1>Outils d'administration</h1>
  <p class="muted">Session : <code><?= htmlspecialchars($_SESSION['user']) ?></code> (admin)</p>
  <h2>Diagnostic reseau</h2>
  <p class="muted">Vérifie la joignabilite d'un hote interne (ping).</p>
  <form method="post" action="/admin/tools.php">
    <label>Hote <input name="host" value="<?= htmlspecialchars($host) ?>" placeholder="127.0.0.1" required></label>
    <button>Tester</button>
  </form>
  <?php if ($out !== ''): ?>
  <h2>Resultat</h2>
  <pre><?= htmlspecialchars($out) ?></pre>
  <?php endif; ?>
</div>
</body>
</html>
