<?php
session_start();
// VULNERABILITE (Session Management) : la "console admin" est ouverte par un
// simple cookie lisible par le client — aucune verification serveur ici.
if (($_COOKIE['soc_role'] ?? '') !== 'admin') {
    http_response_code(403);
    die('Console reservee aux administrateurs SOC.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>SentinelSOC — Console admin</title>
<link rel="stylesheet" href="style.css"></head>
<body>
<div class="card wide">
  <h1>Console administrateur SOC</h1>
  <p class="muted">Bienvenue sur la console d'administration.</p>
  <ul class="menu">
    <li><a href="/admin/tools.php">Outils d'administration</a></li>
  </ul>
  <p class="muted">Note : certaines actions sensibles exigent une session
  administrateur valide (coté serveur).</p>
</div>
</body>
</html>
