<?php
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Database.php';

class PacientesController {
    private $paciente;
    
    public function __construct() {
        $this->checkAuth();
    }

    private function checkAuth() {
        if(!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public function index() {
        $pacientes = Paciente::getAllByUser($_SESSION['usuario_id']);
        include __DIR__ . '/../views/pacientes/listar.php';
    }

    public function mostrar($id) {
        $paciente = Paciente::getById($id);
        if(!$paciente || $paciente->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Paciente não encontrado', 'danger', '/pacientes');
        }
        include __DIR__ . '/../views/pacientes/ver.php';
    }

    public function criar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paciente = new Paciente();
            $paciente->usuario_id = $_SESSION['usuario_id'];
            $this->popularDadosPaciente($paciente, $_POST);
            
            try {
                $paciente->create();
                $this->redirectComMensagem('Paciente cadastrado com sucesso', 'success', '/pacientes');
            } catch(Exception $e) {
                $this->redirectComMensagem('Erro ao cadastrar: ' . $e->getMessage(), 'danger', '/pacientes/criar');
            }
        }
        include __DIR__ . '/../views/pacientes/formulario.php';
    }

    public function editar($id) {
        $paciente = Paciente::getById($id);
        if(!$paciente || $paciente->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Paciente não encontrado', 'danger', '/pacientes');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->popularDadosPaciente($paciente, $_POST);
            
            try {
                $paciente->update();
                $this->redirectComMensagem('Dados atualizados', 'success', '/pacientes/' . $id);
            } catch(Exception $e) {
                $this->redirectComMensagem('Erro ao atualizar: ' . $e->getMessage(), 'danger', '/pacientes/editar/' . $id);
            }
        }
        include __DIR__ . '/../views/pacientes/formulario.php';
    }

    public function excluir($id) {
        $paciente = Paciente::getById($id);
        if(!$paciente || $paciente->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Paciente não encontrado', 'danger', '/pacientes');
        }

        try {
            $paciente->delete();
            $this->redirectComMensagem('Paciente removido', 'success', '/pacientes');
        } catch(Exception $e) {
            $this->redirectComMensagem('Erro ao excluir: ' . $e->getMessage(), 'danger', '/pacientes');
        }
    }

    private function popularDadosPaciente($paciente, $dados) {
        $paciente->nome = $dados['nome'] ?? '';
        $paciente->data_nascimento = $dados['data_nascimento'] ?? null;
        $paciente->cpf = $dados['cpf'] ?? '';
        $paciente->sexo = $dados['sexo'] ?? '';
        $paciente->escolaridade = $dados['escolaridade'] ?? '';
        $paciente->telefone = $dados['telefone'] ?? '';
        $paciente->email = $dados['email'] ?? '';
        $paciente->responsavel = $dados['responsavel'] ?? '';
        $paciente->historico = $dados['historico'] ?? '';
        $paciente->observacoes = $dados['observacoes'] ?? '';
    }

    private function redirectComMensagem($mensagem, $tipo, $url) {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
        header('Location: ' . $url);
        exit();
    }
}