<div class="perfil-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Meu Perfil</h2>
                <a href="?page=dashboard" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
            </div>

            <!-- Formulário de Perfil -->
            <div class="card">
                <div class="card-body">
                    <form id="formPerfil" method="POST">
                        <!-- Dados Pessoais -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Dados Pessoais</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" 
                                           value="<?= htmlspecialchars($usuario->nome) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" 
                                           value="<?= htmlspecialchars($usuario->email) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CRP</label>
                                    <input type="text" class="form-control" name="crp" 
                                           value="<?= htmlspecialchars($usuario->crp) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-control" name="cpf" 
                                           value="<?= htmlspecialchars($usuario->cpf) ?>" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" name="telefone" 
                                           value="<?= htmlspecialchars($usuario->telefone) ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Alterar Senha -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Segurança</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Senha Atual</label>
                                    <input type="password" class="form-control" name="senha_atual">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nova Senha</label>
                                    <input type="password" class="form-control" name="nova_senha">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirmar Nova Senha</label>
                                    <input type="password" class="form-control" name="confirmar_senha">
                                </div>
                            </div>
                            <div class="form-text mt-2">
                                Deixe em branco para manter a senha atual
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>