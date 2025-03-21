<?php
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Atividade.php';
require_once __DIR__ . '/../models/Database.php';

class RelatoriosController {
    public function __construct() {
        $this->checkAuth();
    }

    private function checkAuth() {
        if(!isset($_SESSION['usuario_id'])) {
            header('Location: /neuropp/?page=auth&action=login');
            exit();
        }
    }

    public function gerarProgresso($paciente_id) {
        $paciente = Paciente::getById($paciente_id);
        if(!$paciente || $paciente->usuario_id != $_SESSION['usuario_id']) {
            $this->redirectComMensagem('Paciente não encontrado', 'danger', '/pacientes');
        }

        // Obter dados para o relatório
        $dados = [
            'paciente' => $paciente,
            'atividades' => $this->obterAtividadesPaciente($paciente_id),
            'avaliacoes' => $this->obterAvaliacoes($paciente_id)
        ];

        // Gerar PDF
        $this->gerarPDF('progresso', $dados);
    }

    public function gerarAvaliacao($avaliacao_id) {
        // Lógica similar para avaliações específicas
    }

    private function obterAtividadesPaciente($paciente_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT * FROM atividade_aplicada 
            WHERE paciente_id = ? 
            ORDER BY data_aplicacao DESC
        ");
        $stmt->execute([$paciente_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function obterAvaliacoes($paciente_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT * FROM avaliacoes 
            WHERE paciente_id = ? 
            ORDER BY data_avaliacao DESC
        ");
        $stmt->execute([$paciente_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function gerarPDF($tipo, $dados) {
        // Configurar PDF (exemplo usando TCPDF)
        require_once __DIR__ . '/../lib/tcpdf/tcpdf.php';
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('NeuroPP');
        $pdf->SetTitle('Relatório - ' . $dados['paciente']->nome);
        
        $pdf->AddPage();
        ob_start();
        include __DIR__ . "/../views/relatorios/{$tipo}_template.php";
        $html = ob_get_clean();
        
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('relatorio.pdf', 'I');
        exit();
    }

    private function redirectComMensagem($mensagem, $tipo, $url) {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
        header('Location: ' . $url);
        exit();
    }
}