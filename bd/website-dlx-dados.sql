-- CRIAR MÓDULO NO PAINEL-DLX
INSERT INTO dlx_paineldlx_modulos (modulo_nome, modulo_descr, modulo_ordem, modulo_link)
    VALUES ('Website', 'Gerenciar website.', 1, 'javascript:');

SET @ID_MODULO = last_insert_id();

INSERT INTO dlx_paineldlx_modulos (modulo_pai, modulo_nome, modulo_descr, modulo_link, modulo_exibir_menu) VALUES
    (@ID_MODULO, 'Configurações', 'Gerenciar configurações do website.', 'website/configuracoes', 1),
    (@ID_MODULO, 'Assuntos de contatos', 'Assuntos a serem exibidos no formulário de contato para facilitar o tratamentos dos contatos recebidos.', 'website/assuntos-de-contatos', 1),
    (@ID_MODULO, 'Contatos recebidos', 'Contatos recebidos através do formulário do website.', 'website/contatos-recebidos', 1),
    (@ID_MODULO, 'Tipos de informações de contato', 'Tipos de informações de contatos aceitas. Essa configuração pode incluir validação e máscara de dados.', 'website/tipos-de-informacoes', 0),
    (@ID_MODULO, 'Informações de contato', 'Informações de contato e redes sociais.', 'website/informacoes-de-contato', 1);

-- CRIAR REGISTRO DE CONFIGURAÇÕES DO WEBSITE
INSERT INTO dlx_websitedlx_configuracoes VALUES ('padrao');

-- INCLUIR OS TIPOS DE INFORMAÇÕES DE CONTATO MAIS USADOS
INSERT INTO dlx_websitedlx_tipos_infos (tipo_info_nome, tipo_info_prefixo, tipo_info_rede_social, tipo_info_validacao, tipo_info_mask) VALUES
    ('Telefone', NULL, 0, '^\([0-9]{2}\)\\s[0-9]{4}\\-[0-9]{4}$', '(00) 0000-0000'),
    ('Celular', NULL, 0, '^\([0-9]{2}\)\\s(?:[89]\s)?[0-9]{4}\\-[0-9]{4}$', '(00) 0 0000-0000'),
    ('Endereço', NULL, 0, NULL, NULL),
    ('Email', '@', 0, NULL, NULL),
    ('Facebook', 'https://facebook.com/', 1, NULL, NULL),
    ('Instagram', 'https://instagram.com/', 1, NULL, NULL),
    ('Twitter', 'https://twitter.com/', 1, NULL, NULL),
    ('YouTube', NULL, 1, NULL, NULL);
