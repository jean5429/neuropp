<div class="atividades-list">
    <div class="d-flex justify-content-between mb-4">
        <h2>Todas as Atividades</h2>
        <a href="?page=atividades&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nova Atividade
        </a>
    </div>

    <div class="row">
        <?php foreach($atividades as $atividade): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 activity-card">
                <div class="card-header bg-<?= $atividade->tipo_cor ?>">
                    <h5 class="mb-0 text-white"><?= htmlspecialchars($atividade->titulo) ?></h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-secondary">
                            <?= htmlspecialchars($atividade->area_nome) ?>
                        </span>
                    </div>
                    <p class="card-text"><?= htmlspecialchars($atividade->descricao) ?></p>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                    <a href="?page=atividades&action=show&id=<?= $atividade->id ?>" 
                       class="btn btn-sm btn-outline-primary">
                        Detalhes
                    </a>
                    <div class="btn-group">
                        <a href="?page=atividades&action=edit&id=<?= $atividade->id ?>" 
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger delete-activity" 
                                data-id="<?= $atividade->id ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>