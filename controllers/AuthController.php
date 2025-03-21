<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = sanitizeInput($_POST['email']);
            $senha = $_POST['senha'];

            $usuario = $this->verificarCredenciais($email, $senha);

            if($usuario) {
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;
                $_SESSION['usuario_email'] = $usuario->email;
                $_SESSION['usuario_tipo'] = $usuario->tipo;
                
                header('Location: ?page=dashboard');
                exit();
            } else {
                $_SESSION['erro'] = 'Credenciais inválidas';
                header('Location: ?page=auth&action=login');
                exit();
            }
        }
        include 'views/auth/login.php';
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['senha'] !== $_POST['confirmar_senha']) {
                $_SESSION['erro'] = 'As senhas não coincidem';
                header('Location: ?page=auth&action=register');
                exit();
            }

            if($this->emailExiste($_POST['email'])) {
                $_SESSION['erro'] = 'E-mail já cadastrado';
                header('Location: ?page=auth&action=register');
                exit();
            }

            try {
                $usuario = new Usuario();
                $usuario->nome = sanitizeInput($_POST['nome']);
                $usuario->email = sanitizeInput($_POST['email']);
                $usuario->senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $usuario->cpf = sanitizeInput($_POST['cpf']);
                $usuario->crp = sanitizeInput($_POST['crp']);
                $usuario->tipo = 'profissional';
                $usuario->ativo = true;
                $usuario->create();

                $_SESSION['sucesso'] = 'Cadastro realizado com sucesso!';
                header('Location: ?page=auth&action=login');
                exit();

            } catch(Exception $e) {
                $_SESSION['erro'] = 'Erro ao cadastrar: ' . $e->getMessage();
                header('Location: ?page=auth&action=register');
                exit();
            }
        }
        include 'views/auth/register.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ?page=auth&action=login');
        exit();
    }

    private function verificarCredenciais($email, $senha) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetchObject();

        if($usuario && password_verify($senha, $usuario->senha_hash)) {
            return $usuario;
        }
        return false;
    }

    private function emailExiste($email) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}