<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="?page=dashboard">NeuroPP</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu principal (apenas para usuários logados) -->
            <?php if(isset($_SESSION['usuario_id'])): ?>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=dashboard"><i class="fas fa-home me-1"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pacientes"><i class="fas fa-users me-1"></i>Pacientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=atividades"><i class="fas fa-tasks me-1"></i>Atividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=relatorios"><i class="fas fa-chart-bar me-1"></i>Relatórios</a>
                </li>
            </ul>
            <?php endif; ?>

            <!-- Área do usuário -->
            <div class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="me-2">
                                <i class="fas fa-user-circle fs-5"></i>
                            </div>
                            <div>
                                <span class="d-none d-md-inline"><?= $_SESSION['usuario_nome'] ?></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="?page=perfil">
                                    <i class="fas fa-user-cog me-2"></i>Meu Perfil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="?page=auth&action=logout">
                                    <i class="fas fa-sign-out-alt me-2"></i>Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="d-flex gap-2">
                        <a href="?page=auth&action=login" class="btn btn-outline-light">
                            <i class="fas fa-sign-in-alt me-2"></i>Entrar
                        </a>
                        <a href="?page=auth&action=register" class="btn btn-light">
                            <i class="fas fa-user-plus me-2"></i>Cadastrar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>