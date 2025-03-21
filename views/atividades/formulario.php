<div class="atividade-detail">
    <div class="d-flex justify-content-between mb-4">
        <h2><?= htmlspecialchars($atividade->titulo) ?></h2>
        <a href="?page=atividades" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detalhes da Atividade</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Área Cognitiva:</dt>
                        <dd class="col-sm-9"><?= htmlspecialchars($atividade->area_nome) ?></dd>

                        <dt class="col-sm-3">Tipo:</dt>
                        <dd class="col-sm-9"><?= $atividade->sistema ? 'Sistema' : 'Personalizada' ?></dd>

                        <dt class="col-sm-3">Criado em:</dt>
                        <dd class="col-sm-9"><?= date('d/m/Y H:i', strtotime($atividade->data_criacao)) ?></dd>

                        <dt class="col-sm-3">Parâmetros:</dt>
                        <dd class="col-sm-9">
                            <ul class="list-unstyled">
                                <?php foreach(json_decode($atividade->parametros) as $param => $valor): ?>
                                <li><strong><?= $param ?>:</strong> <?= $valor ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <a href="?page=atividades&action=aplicar&id=<?= $atividade->id ?>" 
                       class="btn btn-success w-100 mb-2">
                        <i class="fas fa-play me-2"></i>Aplicar Atividade
                    </a>
                    <a href="?page=atividades&action=edit&id=<?= $atividade->id ?>" 
                       class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-edit me-2"></i>Editar
                    </a>
                    <button class="btn btn-danger w-100 delete-activity" 
                            data-id="<?= $atividade->id ?>">
                        <i class="fas fa-trash me-2"></i>Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>