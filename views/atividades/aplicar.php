<div class="aplicar-atividade">
    <div class="d-flex justify-content-between mb-4">
        <h2>Aplicar Atividade: <?= htmlspecialchars($atividade->titulo) ?></h2>
        <a href="?page=atividades&action=show&id=<?= $atividade->id ?>" 
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Seleção de Paciente</h5>
                </div>
                <div class="card-body">
                    <select class="form-select" id="selecionarPaciente">
                        <option value="">Selecione um paciente</option>
                        <?php foreach($pacientes as $paciente): ?>
                        <option value="<?= $paciente->id ?>">
                            <?= htmlspecialchars($paciente->nome) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Configurações</h5>
                </div>
                <div class="card-body">
                    <form id="formAplicarAtividade">
                        <?php foreach(json_decode($atividade->parametros) as $param => $valor): ?>
                        <div class="mb-3">
                            <label class="form-label"><?= $param ?></label>
                            <input type="text" class="form-control" 
                                   name="parametros[<?= $param ?>]" 
                                   value="<?= $valor ?>">
                        </div>
                        <?php endforeach; ?>

                        <div class="mb-3">
                            <label class="form-label">Observações</label>
                            <textarea class="form-control" name="observacoes" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-play me-2"></i>Iniciar Atividade
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>