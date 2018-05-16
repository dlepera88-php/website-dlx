-- CONFIGURAÇÕES DO WEBSITE
CREATE TABLE dlx_websitedlx_configuracoes (
    config_tema VARCHAR(50) NOT NULL DEFAULT 'padrao',
    config_email_contato VARCHAR(200),
    config_ga_ua VARCHAR(13)
) ENGINE = INNODB;


-- ASSUNTOS DE CONTATOS
CREATE TABLE dlx_websitedlx_assuntos_contato (
    assunto_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assunto_contato_texto VARCHAR(50) NOT NULL,
    assunto_contato_cor VARCHAR(7) NOT NULL DEFAULT '#000',
    assunto_contato_email VARCHAR(200),
    assunto_contato_publicar BOOL NOT NULL DEFAULT 1,
    assunto_contato_delete BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;


-- CONTATOS RECEBIDOS
CREATE TABLE dlx_websitedlx_contatos (
    contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contato_assunto INT,
    contato_nome VARCHAR(150) NOT NULL,
    contato_email VARCHAR(200) NOT NULL,
    contato_telefone VARCHAR(16),
    contato_mensagem LONGTEXT NOT NULL,
    contato_delete BOOL NOT NULL DEFAULT 0,
    CONSTRAINT FK_contato_assunto FOREIGN KEY (contato_assunto) REFERENCES dlx_websitedlx_assuntos_contato (assunto_contato_id)
) ENGINE = INNODB;

-- INFORMAÇÕES DE CONTATO
CREATE TABLE dlx_websitedlx_tipos_infos (
    tipo_info_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo_info_nome VARCHAR(100) NOT NULL,
    tipo_info_prefixo VARCHAR(100),
    tipo_info_rede_social BOOL NOT NULL DEFAULT 0,
    tipo_info_validacao VARCHAR(255),
    tipo_info_mask VARCHAR(100),
    tipo_info_publicar BOOL NOT NULL DEFAULT 1,
    tipo_info_delete BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;

CREATE TABLE dlx_websitedlx_infos_contato (
    info_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    info_contato_tipo INT NOT NULL,
    info_contato_valor VARCHAR(255) NOT NULL,
    info_contato_exibicao VARCHAR(255),
    info_contato_publicar BOOL NOT NULL DEFAULT 1,
    info_contato_delete BOOL NOT NULL DEFAULT 0,
    CONSTRAINT FK_info_contato_tipo FOREIGN KEY (info_contato_tipo) REFERENCES dlx_websitedlx_tipos_infos (tipo_info_id)
) ENGINE=INNODB;

-- INFORMAÇÕES INSTITUCIONAIS
CREATE TABLE dlx_websitedlx_institucional (
    instit_idioma VARCHAR(5) NOT NULL PRIMARY KEY,
    instit_texto LONGTEXT,
    instit_resumo TEXT,
    instit_publicar BOOL NOT NULL DEFAULT 1,
    instit_delete BOOL NOT NULL DEFAULT 0
) ENGINE=INNODB;
