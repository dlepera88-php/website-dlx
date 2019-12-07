-- CONFIGURAÇÕES DO WEBSITE
CREATE TABLE website.Configuracao (
    config_tema VARCHAR(50) NOT NULL DEFAULT 'padrao',
    config_email_contato VARCHAR(200)
) ENGINE = INNODB;


-- ASSUNTOS DE CONTATOS
CREATE TABLE website.AssuntoContato (
    assunto_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL,
    cor VARCHAR(7) NOT NULL DEFAULT '#000',
    email VARCHAR(200),
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;


-- CONTATOS RECEBIDOS
CREATE TABLE website.ContatoRecebido (
    contato_recebido_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assunto_contato_id INT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(200) NOT NULL,
    telefone VARCHAR(16),
    mensagem LONGTEXT NOT NULL,
    deletado BOOL NOT NULL DEFAULT 0,
    CONSTRAINT FK_contato_assunto FOREIGN KEY (assunto_contato_id) REFERENCES website.AssuntoContato (assunto_contato_id)
) ENGINE = INNODB;

-- INFORMAÇÕES DE CONTATO
DROP TABLE IF EXISTS website.InformacaoContatoTipo;
CREATE TABLE website.InformacaoContatoTipo (
    informacao_contato_tipo_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    rede_social BOOL NOT NULL DEFAULT 0,
    prefixo varchar(200),
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;

DROP TABLE IF EXISTS website.InformacaoContato;
CREATE TABLE website.InformacaoContato (
    informacao_contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    informacao_contato_tipo_id INT NOT NULL references website.InformacaoContatoTipo (informacao_contato_tipo_id),
    contato VARCHAR(255) NOT NULL,
    deletado BOOL NOT NULL DEFAULT 0
) ENGINE = INNODB;

-- INFORMAÇÕES INSTITUCIONAIS
# CREATE TABLE website.Institucional (
#     idioma VARCHAR(5) NOT NULL PRIMARY KEY,
#     texto LONGTEXT,
#     resumo TEXT,
#     deletado BOOL NOT NULL DEFAULT 0
# ) ENGINE = INNODB;
