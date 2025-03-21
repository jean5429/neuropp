<div class="atividades-container">
    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Banco de Atividades</h2>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filtrarModal">
                <i class="fas fa-filter me-2"></i>Filtrar
            </button>
            <a href="?page=atividades&action=create" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Nova Atividade
            </a>
        </div>
    </div>

    <!-- Abas -->
    <ul class="nav nav-tabs mb-4" id="abasAtividades">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#sistema">Atividades do Sistema</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#personalizadas">Minhas Atividades</a>
        </li>
    </ul>

    <!-- Conteúdo das Abas -->
    <div class="tab-content">
        <!-- Atividades do Sistema -->
        <div class="tab-pane fade show active" id="sistema">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach($sistemaAtividades as $atividade): ?>
                <div class="col">
                    <div class="card h-100 activity-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><?= htmlspecialchars($atividade->titulo) ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($atividade->descricao) ?></p>
                            <div class="badge bg-secondary">
                                <?= htmlspecialchars($atividade->area_nome) ?>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-sm btn-outline-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detalhesAtividade"
                                    data-id="<?= $atividade->id ?>">
                                Detalhes
                            </button>
                            <a href="?page=atividades&action=aplicar&id=<?= $atividade->id ?>" 
                               class="btn btn-sm btn-success">
                                Aplicar
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Atividades Personalizadas -->
        <div class="tab-pane fade" id="personalizadas">
            <?php if(count($atividades) > 0): ?>
                <div class="list-group">
                    <?php foreach($atividades as $atividade): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5><?= htmlspecialchars($atividade->titulo) ?></h5>
                                <p class="mb-0 text-muted"><?= htmlspecialchars($atividade->descricao) ?></p>
                            </div>
                            <div class="btn-group">
                                <a href="?page=atividades&action=edit&id=<?= $atividade->id ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger delete-activity"
                                        data-id="<?= $atividade->id ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Nenhuma atividade personalizada cadastrada ainda.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Detalhes -->
<div class="modal fade" id="detalhesAtividade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhes da Atividade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detalhesConteudo">
                <!-- Conteúdo carregado via AJAX -->
            </div>
        </div>
    </div>
</div>