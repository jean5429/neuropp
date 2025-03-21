<div class="paciente-form">
    <h2 class="mb-4"><?= isset($paciente) ? 'Editar' : 'Novo' ?> Paciente</h2>

    <form method="POST">
        <div class="row g-3">
            <!-- Dados Pessoais -->
            <div class="col-md-6">
                <label class="form-label">Nome Completo</label>
                <input type="text" class="form-control" name="nome" 
                       value="<?= $paciente->nome ?? '' ?>" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" 
                       value="<?= $paciente->data_nascimento ?? '' ?>" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Sexo</label>
                <select class="form-select" name="sexo" required>
                    <option value="M" <?= ($paciente->sexo ?? '') === 'M' ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= ($paciente->sexo ?? '') === 'F' ? 'selected' : '' ?>>Feminino</option>
                    <option value="Outro" <?= ($paciente->sexo ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
                </select>
            </div>

            <!-- Contato -->
            <div class="col-md-4">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" 
                       value="<?= $paciente->cpf ?? '' ?>" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefone" 
                       value="<?= $paciente->telefone ?? '' ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" 
                       value="<?= $paciente->email ?? '' ?>">
            </div>

            <!-- Histórico -->
            <div class="col-12">
                <label class="form-label">Escolaridade</label>
                <input type="text" class="form-control" name="escolaridade" 
                       value="<?= $paciente->escolaridade ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Responsável</label>
                <input type="text" class="form-control" name="responsavel" 
                       value="<?= $paciente->responsavel ?? '' ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Histórico Clínico</label>
                <textarea class="form-control" name="historico" rows="4"><?= $paciente->historico ?? '' ?></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Observações</label>
                <textarea class="form-control" name="observacoes" rows="4"><?= $paciente->observacoes ?? '' ?></textarea>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Salvar
                </button>
            </div>
        </div>
    </form>
</div>