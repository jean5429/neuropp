-- Criar Banco de Dados
CREATE DATABASE IF NOT EXISTS neuropp_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE neuropp_db;

-- Tabela de Usuários (Profissionais)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha_hash VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    crp VARCHAR(20),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultimo_login DATETIME,
    tipo ENUM('admin', 'profissional') DEFAULT 'profissional',
    ativo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB;

-- Tabela de Pacientes
CREATE TABLE IF NOT EXISTS pacientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE,
    cpf VARCHAR(14) UNIQUE,
    sexo ENUM('M', 'F', 'Outro'),
    escolaridade VARCHAR(50),
    telefone VARCHAR(20),
    email VARCHAR(100),
    responsavel VARCHAR(100),
    historico TEXT,
    observacoes TEXT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de Áreas Cognitivas
CREATE TABLE IF NOT EXISTS areas_cognitivas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT
) ENGINE=InnoDB;

-- Tabela de Tipos de Atividade
CREATE TABLE IF NOT EXISTS tipo_atividade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    area_id INT NOT NULL,
    descricao TEXT,
    parametros JSON,
    FOREIGN KEY (area_id) REFERENCES areas_cognitivas(id)
) ENGINE=InnoDB;

-- Tabela de Atividades
CREATE TABLE IF NOT EXISTS atividades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo_id INT NOT NULL,
    usuario_id INT,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    conteudo TEXT NOT NULL,
    parametros JSON,
    publica BOOLEAN DEFAULT FALSE,
    sistema BOOLEAN DEFAULT FALSE,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_id) REFERENCES tipo_atividade(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabela de Atividades Aplicadas
CREATE TABLE IF NOT EXISTS atividade_aplicada (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    atividade_id INT NOT NULL,
    usuario_id INT NOT NULL,
    data_aplicacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    duracao INT,
    pontuacao INT,
    observacoes TEXT,
    resultados JSON,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (atividade_id) REFERENCES atividades(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- Tabela de Avaliações
CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('inicial', 'periodica', 'final') DEFAULT 'periodica',
    data_avaliacao DATE NOT NULL,
    resultados JSON,
    observacoes TEXT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- Tabela de Relatórios
CREATE TABLE IF NOT EXISTS relatorios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('progresso', 'avaliacao', 'personalizado') NOT NULL,
    periodo_inicio DATE,
    periodo_fim DATE,
    conteudo TEXT NOT NULL,
    dados_graficos JSON,
    arquivo_path VARCHAR(255),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- Tabela de Históricos
CREATE TABLE IF NOT EXISTS historicos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('observacao', 'evento', 'alteracao'),
    descricao TEXT NOT NULL,
    data_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- Índices para otimização
CREATE INDEX idx_pacientes_usuario ON pacientes(usuario_id);
CREATE INDEX idx_atividades_tipo ON atividades(tipo_id);
CREATE INDEX idx_aplicadas_paciente ON atividade_aplicada(paciente_id);
CREATE INDEX idx_avaliacoes_data ON avaliacoes(data_avaliacao);