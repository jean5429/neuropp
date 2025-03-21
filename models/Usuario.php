<?php
require_once __DIR__ . '/Database.php';

class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha_hash;
    public $cpf;
    public $crp;
    public $data_cadastro;
    public $ultimo_login;
    public $tipo;
    public $ativo;

    public function __construct() {}

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(__CLASS__);
    }

    public static function getByEmail($email) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([sanitizeInput($email)]);
        return $stmt->fetchObject(__CLASS__);
    }

    public function create() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO usuarios (
            nome, email, senha_hash, cpf, crp, tipo, ativo
        ) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            sanitizeInput($this->nome),
            sanitizeInput($this->email),
            $this->senha_hash,
            sanitizeInput($this->cpf),
            sanitizeInput($this->crp),
            $this->tipo,
            $this->ativo ? 1 : 0
        ]);

        $this->id = $db->lastInsertId();
        return $this;
    }

    public function update() {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE usuarios SET
            nome = ?,
            email = ?,
            cpf = ?,
            crp = ?,
            tipo = ?,
            ativo = ?
        WHERE id = ?");

        $stmt->execute([
            sanitizeInput($this->nome),
            sanitizeInput($this->email),
            sanitizeInput($this->cpf),
            sanitizeInput($this->crp),
            $this->tipo,
            $this->ativo ? 1 : 0,
            $this->id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function updatePassword($new_password) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE usuarios SET
            senha_hash = ?
        WHERE id = ?");

        $stmt->execute([
            password_hash($new_password, PASSWORD_DEFAULT),
            $this->id
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete() {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$this->id]);
        return $stmt->rowCount() > 0;
    }

    public static function getAll($limit = 100) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM usuarios ORDER BY data_cadastro DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function recordLogin() {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE usuarios SET ultimo_login = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$this->id]);
    }

    public function getPacientes() {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pacientes WHERE usuario_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Paciente');
    }
}