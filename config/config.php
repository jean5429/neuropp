<?php
session_name('NEUROPP_SESS');
session_start();

$host = 'localhost';
$db   = 'neuropp_db';
$user = 'neuropp_user';
$pass = 'Jinf&jhuif&3469@';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Funções úteis
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}