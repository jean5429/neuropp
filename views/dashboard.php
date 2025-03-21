<div class="dashboard">
    <!-- Cabeçalho -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Dashboard</h2>
            <p class="lead">Bem-vindo de volta, <?= $_SESSION['usuario_nome'] ?? 'Profissional' ?></p>
        </div>
        <div class="col-md-6 text-end">
            <div class="stats-badge">
                <i class="fas fa-users"></i>
                <span class="count"><?= $totalPacientes ?></span>
                <span class="label">Pacientes</span>
            </div>
        </div>
    </div>

    <!-- Gráfico de Progresso -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="chart-container">
                <h5 class="mb-3">Progresso dos Pacientes</h5>
                <canvas id="progressChart" height="120"></canvas>
            </div>
        </div>
        
        <!-- Atividades Recentes -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Atividades Recentes</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php foreach($atividadesRecentes as $atividade): ?>
                        <li class="list-group-item small">
                            <div class="d-flex justify-content-between">
                                <span><?= htmlspecialchars($atividade->titulo) ?></span>
                                <span class="text-muted"><?= date('d/m', strtotime($atividade->data_aplicacao)) ?></span>
                            </div>
                            <div class="text-muted">
                                <?= htmlspecialchars($atividade->paciente_nome) ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Ação Rápida -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="?page=pacientes&action=create" class="card card-custom text-center py-4">
                <div class="card-body">
                    <i class="fas fa-user-plus fa-2x mb-3"></i>
                    <h6>Novo Paciente</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="?page=atividades" class="card card-custom text-center py-4">
                <div class="card-body">
                    <i class="fas fa-tasks fa-2x mb-3"></i>
                    <h6>Atividades</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="?page=relatorios" class="card card-custom text-center py-4">
                <div class="card-body">
                    <i class="fas fa-chart-bar fa-2x mb-3"></i>
                    <h6>Relatórios</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="?page=perfil" class="card card-custom text-center py-4">
                <div class="card-body">
                    <i class="fas fa-cog fa-2x mb-3"></i>
                    <h6>Configurações</h6>
                </div>
            </a>
        </div>
    </div>
</div>