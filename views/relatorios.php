<div class="relatorios-container">
    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Relatórios e Análises</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novoRelatorio">
            <i class="fas fa-file-alt me-2"></i>Novo Relatório
        </button>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form id="filtroRelatorios">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Paciente</label>
                        <select class="form-select" name="paciente">
                            <option value="">Todos</option>
                            <?php foreach($pacientes as $paciente): ?>
                            <option value="<?= $paciente->id ?>">
                                <?= htmlspecialchars($paciente->nome) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Período Inicial</label>
                        <input type="date" class="form-control" name="data_inicio">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Período Final</label>
                        <input type="date" class="form-control" name="data_fim">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Relatórios -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th>Paciente</th>
                            <th>Período</th>
                            <th>Data Criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($relatorios as $relatorio): ?>
                        <tr>
                            <td>
                                <span class="badge bg-<?= $relatorio->tipo_cor ?>">
                                    <?= ucfirst($relatorio->tipo) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($relatorio->paciente_nome) ?></td>
                            <td>
                                <?php if($relatorio->periodo_inicio): ?>
                                    <?= date('d/m/Y', strtotime($relatorio->periodo_inicio)) ?> - 
                                    <?= date('d/m/Y', strtotime($relatorio->periodo_fim)) ?>
                                <?php else: ?>
                                    Completo
                                <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($relatorio->data_criacao)) ?></td>
                            <td>
                                <a href="<?= $relatorio->arquivo_path ?>" 
                                   class="btn btn-sm btn-outline-primary"
                                   download>
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger delete-report"
                                        data-id="<?= $relatorio->id ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Novo Relatório -->
<div class="modal fade" id="novoRelatorio">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gerar Novo Relatório</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formRelatorio">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Relatório</label>
                            <select class="form-select" name="tipo" required>
                                <option value="progresso">Progresso</option>
                                <option value="avaliacao">Avaliação</option>
                                <option value="personalizado">Personalizado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Paciente</label>
                            <select class="form-select" name="paciente_id" required>
                                <?php foreach($pacientes as $paciente): ?>
                                <option value="<?= $paciente->id ?>">
                                    <?= htmlspecialchars($paciente->nome) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Período Inicial</label>
                            <input type="date" class="form-control" name="periodo_inicio">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Período Final</label>
                            <input type="date" class="form-control" name="periodo_fim">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">
                                Gerar Relatório
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>