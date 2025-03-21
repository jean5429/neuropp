<div class="auth-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">Acesso Profissional</h2>
                    
                    <?php if(isset($_SESSION['erro'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
                        <?php unset($_SESSION['erro']); ?>
                    <?php endif; ?>

                    <form method="POST" action="?page=auth&action=login">
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Entrar
                        </button>
                        
                        <div class="text-center">
                            <a href="?page=auth&action=forgot" class="text-muted small">Esqueceu a senha?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>