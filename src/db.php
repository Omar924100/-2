<?php
function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $dsn = 'mysql:host=db;dbname=sentinel_soc;charset=utf8mb4';
    $last = null;
    for ($i = 0; $i < 45; $i++) {
        try {
            $pdo = new PDO($dsn, 'app', 'apppw', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            $last = $e;
            sleep(1);
        }
    }
    http_response_code(500);
    die('Base de donnees indisponible.');
}
