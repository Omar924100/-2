<?php
require __DIR__ . '/db.php';
session_start();
if (empty($_SESSION['user'])) { header('Location: index.php'); exit; }

$q = $_GET['q'] ?? '';
$results = [];
if ($q !== '') {
    // VULNERABILITE (SQLi) : recherche construite par concatenation.
    // 5 colonnes affichees : id, alerte, severite, date, contenu
    $sql = "SELECT id, title, severity, created_at, body FROM logs
            WHERE title LIKE '%$q%' OR body LIKE '%$q%'";
    try {
        $results = db()->query($sql)->fetchAll();
    } catch (Throwable $e) {
        // mode debug legacy : l'erreur SQL est renvoyee au client
        echo '<p class="alert">SQL error : ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>SentinelSOC — Recherche d'alertes</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="card wide">
  <h1>Recherche d'alertes</h1>
  <p class="muted">Connecte : <code><?= htmlspecialchars($_SESSION['user']) ?></code> |
  <a href="index.php?logout=1">deconnexion</a></p>
  <form method="get" action="search.php">
    <input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="mots-cles...">
    <button>Chercher</button>
  </form>
  <table>
    <tr><th>#</th><th>Alerte</th><th>Severite</th><th>Date</th><th>Contenu</th></tr>
    <?php foreach ($results as $r): ?>
    <tr>
      <td><?= (int)$r['id'] ?></td>
      <td><?= htmlspecialchars($r['title']) ?></td>
      <td><?= htmlspecialchars($r['severity']) ?></td>
      <td><?= htmlspecialchars($r['created_at']) ?></td>
      <td><?= htmlspecialchars($r['body']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
