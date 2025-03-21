<div class="pacientes-list">
    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between mb-4">
        <h2>Gerenciar Pacientes</h2>
        <a href="?page=pacientes&action=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Novo Paciente
        </a>
    </div>

    <!-- Barra de Pesquisa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar pacientes...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Tabela de Pacientes -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Última Atividade</th>
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
                                <?php
                                    $dataNasc = new DateTime($paciente->data_nascimento);
                                    $hoje = new DateTime();
                                    $idade = $hoje->diff($dataNasc)->y;
                                    echo $idade . ' anos';
                                ?>
                            </td>
                            <td>
                                <?php if($paciente->ultima_atividade): ?>
                                    <div class="text-success small">
                                        <?= date('d/m/Y', strtotime($paciente->ultima_atividade)) ?>
                                    </div>
                                    <div class="text-muted small">
                                        <?= htmlspecialchars($paciente->ultima_atividade_titulo) ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Nenhuma atividade</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?= $paciente->progresso ?>%">
                                        <?= $paciente->progresso ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="?page=pacientes&action=show&id=<?= $paciente->id ?>" 
                                       class="btn btn-sm btn-outline-secondary" 
                                       title="Ver detalhes">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="?page=pacientes&action=edit&id=<?= $paciente->id ?>" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-paciente"
                                            data-id="<?= $paciente->id ?>"
                                            title="Excluir">
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