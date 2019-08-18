-- CONFIGURAÇÕES DO WEBSITE
CREATE TABLE dlx_configuracoes (
    config_tema VARCHAR(50) NOT NULL DEFAULT 'padrao',
    config_email_contato VARCHAR(200)
) ENGINE = INNODB;


-- ASSUNTOS DE CONTATOS
CREATE TABLE dlx_assuntos_contato (
    assunto_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL,
    cor VARCHAR(7) NOT NULL DEFAULT '#000',
    email VARCHAR(200),
    publicado BOOL NOT NULL DEFAULT 1,
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;


-- CONTATOS RECEBIDOS
CREATE TABLE dlx_contatos_recebidos (
    contato_recebido_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assunto_contato_id INT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(200) NOT NULL,
    telefone VARCHAR(16),
    mensagem LONGTEXT NOT NULL,
    deletado BOOL NOT NULL DEFAULT 0,
    CONSTRAINT FK_contato_assunto FOREIGN KEY (assunto_contato_id) REFERENCES dlx_assuntos_contato (assunto_contato_id)
) ENGINE = INNODB;

-- INFORMAÇÕES DE CONTATO
CREATE TABLE dlx_informacao_contato_tipo (
    informcao_contato_tipo_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;

CREATE TABLE dlx_informacao_contato (
    informacao_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo INT NOT NULL references informcao_contato_tipo_id (informcao_contato_tipo_id),
    contato VARCHAR(255) NOT NULL,
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE=INNODB;

-- INFORMAÇÕES INSTITUCIONAIS
CREATE TABLE dlx_institucional (
    instit_idioma VARCHAR(5) NOT NULL PRIMARY KEY,
    instit_texto LONGTEXT,
    instit_resumo TEXT,
    instit_publicar BOOL NOT NULL DEFAULT 1,
    instit_delete BOOL NOT NULL DEFAULT 0
) ENGINE=INNODB;
