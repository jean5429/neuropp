<?php
require_once __DIR__ . '/../models/Atividade.php';
require_once __DIR__ . '/../models/Database.php';

class AtividadesController {
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
        $atividades = Atividade::getUserActivities($_SESSION['usuario_id']);
        $sistemaAtividades = Atividade::getSystemActivities();
        include __DIR__ . '/../views/atividades/listar.php';
    }

    public function mostrar($id) {
        $atividade = Atividade::getById($id);
        if(!$atividade || ($atividade->usuario_id !== null && $atividade->usuario_id != $_SESSION['usuario_id'])) {
            $this->redirectComMensagem('Atividade não encontrada', 'danger', '/atividades');
        }
        include __DIR__ . '/../views/atividades/ver.php';
    }

    public function criar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $atividade = new Atividade();
            $atividade->usuario_id = $_SESSION['usuario_id'];
            $this->popularDadosAtividade($atividade, $_POST);

            try {
                $atividade->create();
                $this->redirectComMensagem('Atividade criada com sucesso', 'success', '/atividades');
            } catch(Exception $e) {
                $this->redirectComMensagem('Erro ao criar: ' . $e->getMessage(), 'danger', '/atividades/criar');
            }
        }
        include __DIR__ . '/../views/atividades/formulario.php';
    }

    public function aplicar($paciente_id) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica para registrar aplicação da atividade
            $this->redirectComMensagem('Atividade aplicada com sucesso', 'success', '/pacientes/' . $paciente_id);
        }
        $atividades = Atividade::getAllAvailable($_SESSION['usuario_id']);
        include __DIR__ . '/../views/atividades/aplicar.php';
    }

    public function editar($id) {
        $atividade = Atividade::getById($id);
        if(!$atividade || $atividade->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Atividade não encontrada', 'danger', '/atividades');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->popularDadosAtividade($atividade, $_POST);
            
            try {
                $atividade->update();
                $this->redirectComMensagem('Atividade atualizada', 'success', '/atividades/' . $id);
            } catch(Exception $e) {
                $this->redirectComMensagem('Erro ao atualizar: ' . $e->getMessage(), 'danger', '/atividades/editar/' . $id);
            }
        }
        include __DIR__ . '/../views/atividades/formulario.php';
    }

    public function excluir($id) {
        $atividade = Atividade::getById($id);
        if(!$atividade || $atividade->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Atividade não encontrada', 'danger', '/atividades');
        }

        try {
            $atividade->delete();
            $this->redirectComMensagem('Atividade removida', 'success', '/atividades');
        } catch(Exception $e) {
            $this->redirectComMensagem('Erro ao excluir: ' . $e->getMessage(), 'danger', '/atividades');
        }
    }

    private function popularDadosAtividade($atividade, $dados) {
        $atividade->tipo_id = $dados['tipo_id'] ?? null;
        $atividade->titulo = $dados['titulo'] ?? '';
        $atividade->descricao = $dados['descricao'] ?? '';
        $atividade->conteudo = $dados['conteudo'] ?? '';
        $atividade->parametros = $dados['parametros'] ?? [];
        $atividade->publica = isset($dados['publica']);
    }

    private function redirectComMensagem($mensagem, $tipo, $url) {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
        header('Location: ' . $url);
        exit();
    }
}