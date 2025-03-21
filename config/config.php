<?php
session_name('MUSIC_SESS');
session_start();

// Configurações básicas
define('DB_HOST', 'localhost');
define('DB_NAME', 'neuropp_db');
define('DB_USER', 'neuropp_user');
define('DB_PASS', 'Jinf&jhuif&3469@');

// Conexão com o banco de dados
try {
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",
        DB_USER, 
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Funções úteis
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}