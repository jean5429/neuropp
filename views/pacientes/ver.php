<div class="paciente-detail">
    <div class="d-flex justify-content-between mb-4">
        <h2><?= htmlspecialchars($paciente->nome) ?></h2>
        <div class="btn-group">
            <a href="?page=pacientes&action=edit&id=<?= $paciente->id ?>" 
               class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
            <a href="?page=pacientes" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Coluna Esquerda -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informações Pessoais</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Data Nascimento:</dt>
                        <dd class="col-sm-7"><?= date('d/m/Y', strtotime($paciente->data_nascimento)) ?></dd>
                        
                        <dt class="col-sm-5">Idade:</dt>
                        <dd class="col-sm-7"><?= calcularIdade($paciente->data_nascimento) ?> anos</dd>
                        
                        <dt class="col-sm-5">Sexo:</dt>
                        <dd class="col-sm-7"><?= $paciente->sexo ?></dd>
                        
                        <dt class="col-sm-5">Escolaridade:</dt>
                        <dd class="col-sm-7"><?= htmlspecialchars($paciente->escolaridade) ?></dd>
                    </dl>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Contato</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Telefone:</dt>
                        <dd class="col-sm-7"><?= htmlspecialchars($paciente->telefone) ?></dd>
                        
                        <dt class="col-sm-5">Email:</dt>
                        <dd class="col-sm-7"><?= htmlspecialchars($paciente->email) ?></dd>
                        
                        <dt class="col-sm-5">Responsável:</dt>
                        <dd class="col-sm-7"><?= htmlspecialchars($paciente->responsavel) ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Coluna Direita -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Histórico e Observações</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Histórico Clínico</h6>
                        <p><?= nl2br(htmlspecialchars($paciente->historico)) ?></p>
                    </div>
                    <div class="mb-3">
                        <h6>Observações Recentes</h6>
                        <p><?= nl2br(htmlspecialchars($paciente->observacoes)) ?></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Progresso</h5>
                </div>
                <div class="card-body">
                    <canvas id="progressoChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>