<?php

require 'config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuroPP - Plataforma Neuropsicopedagógica</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="container mt-4">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        $allowed_pages = ['dashboard', 'pacientes', 'atividades', 'relatorios', 'perfil'];
        
        if(in_array($page, $allowed_pages)) {
            include "views/{$page}.php";
        } else {
            include 'views/404.php';
        }
        ?>
    </main>

    <?php include 'includes/footer.php'; ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>