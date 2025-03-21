<div class="pacientes-list">
    <div class="d-flex justify-content-between mb-4">
        <h2>Lista de Pacientes</h2>
        <a href="?page=pacientes&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Novo Paciente
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Última Avaliação</th>
                            <th>Progresso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pacientes as $paciente): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <?= strtoupper(substr($paciente->nome, 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?= htmlspecialchars($paciente->nome) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($paciente->email) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?= calcularIdade($paciente->data_nascimento) ?> anos
                            </td>
                            <td>
                                <?php if($paciente->ultima_avaliacao): ?>
                                    <?= date('d/m/Y', strtotime($paciente->ultima_avaliacao)) ?>
                                <?php else: ?>
                                    <span class="text-muted">Nenhuma</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" 
                                         style="width: <?= $paciente->progresso ?>%">
                                        <?= $paciente->progresso ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="?page=pacientes&action=show&id=<?= $paciente->id ?>" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="?page=pacientes&action=edit&id=<?= $paciente->id ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-paciente"
                                            data-id="<?= $paciente->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>