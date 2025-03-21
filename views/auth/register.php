<div class="auth-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">Cadastro de Profissional</h2>
                    
                    <?php if(isset($_SESSION['erro'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
                        <?php unset($_SESSION['erro']); ?>
                    <?php endif; ?>

                    <form method="POST" action="?page=auth&action=register">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Confirme a Senha</label>
                                <input type="password" class="form-control" name="confirmar_senha" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">CRP</label>
                                <input type="text" class="form-control" name="crp" required>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required>
                                    <label class="form-check-label">
                                        Concordo com os <a href="#">Termos de Uso</a> e 
                                        <a href="#">Política de Privacidade</a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-user-plus me-2"></i>Criar Conta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>