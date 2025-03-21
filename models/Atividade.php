<?php
require_once __DIR__ . '/Database.php';

class Atividade {
    public $id;
    public $tipo_id;
    public $usuario_id;
    public $titulo;
    public $descricao;
    public $conteudo;
    public $parametros;
    public $publica;
    public $sistema;
    public $data_criacao;

    public function __construct() {}

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM atividades WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(__CLASS__);
    }

    public static function getByType($tipo_id, $limit = 100) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM atividades WHERE tipo_id = ? ORDER BY data_criacao DESC LIMIT ?");
        $stmt->execute([$tipo_id, $limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function getUserActivities($usuario_id, $limit = 100) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM atividades WHERE usuario_id = ? ORDER BY data_criacao DESC LIMIT ?");
        $stmt->execute([$usuario_id, $limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function create() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO atividades (
            tipo_id, usuario_id, titulo, descricao, conteudo, parametros, publica, sistema
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $this->tipo_id,
            $this->usuario_id,
            sanitizeInput($this->titulo),
            sanitizeInput($this->descricao),
            $this->conteudo,
            json_encode($this->parametros),
            $this->publica ? 1 : 0,
            $this->sistema ? 1 : 0
        ]);

        $this->id = $db->lastInsertId();
        return $this;
    }

    public function update() {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE atividades SET
            titulo = ?,
            descricao = ?,
            conteudo = ?,
            parametros = ?,
            publica = ?
        WHERE id = ? AND usuario_id = ?");

        $stmt->execute([
            sanitizeInput($this->titulo),
            sanitizeInput($this->descricao),
            $this->conteudo,
            json_encode($this->parametros),
            $this->publica ? 1 : 0,
            $this->id,
            $this->usuario_id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete() {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM atividades WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$this->id, $this->usuario_id]);
        return $stmt->rowCount() > 0;
    }

    public static function getSystemActivities() {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM atividades WHERE sistema = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
}