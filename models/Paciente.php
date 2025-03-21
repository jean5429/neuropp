<?php
require_once __DIR__ . '/Database.php';

class Paciente {
    public $id;
    public $usuario_id;
    public $nome;
    public $data_nascimento;
    public $cpf;
    public $sexo;
    public $escolaridade;
    public $telefone;
    public $email;
    public $responsavel;
    public $historico;
    public $observacoes;
    public $data_cadastro;

    public function __construct() {}

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pacientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(__CLASS__);
    }

    public static function getAllByUser($usuario_id, $limit = 100) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pacientes WHERE usuario_id = ? ORDER BY data_cadastro DESC LIMIT ?");
        $stmt->execute([$usuario_id, $limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function create() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO pacientes (
            usuario_id, nome, data_nascimento, cpf, sexo, escolaridade,
            telefone, email, responsavel, historico, observacoes
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $this->usuario_id,
            sanitizeInput($this->nome),
            $this->data_nascimento,
            sanitizeInput($this->cpf),
            $this->sexo,
            sanitizeInput($this->escolaridade),
            sanitizeInput($this->telefone),
            sanitizeInput($this->email),
            sanitizeInput($this->responsavel),
            sanitizeInput($this->historico),
            sanitizeInput($this->observacoes)
        ]);

        $this->id = $db->lastInsertId();
        return $this;
    }

    public function update() {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE pacientes SET
            nome = ?,
            data_nascimento = ?,
            cpf = ?,
            sexo = ?,
            escolaridade = ?,
            telefone = ?,
            email = ?,
            responsavel = ?,
            historico = ?,
            observacoes = ?
        WHERE id = ? AND usuario_id = ?");

        $stmt->execute([
            sanitizeInput($this->nome),
            $this->data_nascimento,
            sanitizeInput($this->cpf),
            $this->sexo,
            sanitizeInput($this->escolaridade),
            sanitizeInput($this->telefone),
            sanitizeInput($this->email),
            sanitizeInput($this->responsavel),
            sanitizeInput($this->historico),
            sanitizeInput($this->observacoes),
            $this->id,
            $this->usuario_id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete() {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM pacientes WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$this->id, $this->usuario_id]);
        return $stmt->rowCount() > 0;
    }
}