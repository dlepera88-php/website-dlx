-- CRIAR MÓDULO NO PAINEL-DLX
INSERT INTO dlx.Menu (nome) VALUES ('Website');

SET @ID_MODULO = last_insert_id();

INSERT INTO dlx.MenuItem (menu_id, nome, link) VALUES
    (@ID_MODULO, 'Configurações', '/website/configuracoes'),
    (@ID_MODULO, 'Assuntos de contatos', '/website/assuntos-de-contatos'),
    (@ID_MODULO, 'Contatos recebidos', '/website/contatos-recebidos'),
    (@ID_MODULO, 'Tipos de informações de contato', '/website/tipos-de-informacoes'),
    (@ID_MODULO, 'Informações de contato', '/website/informacoes-de-contato'),
    (@ID_MODULO, 'Institucional', '/website/institucional');

-- CRIAR REGISTRO DE CONFIGURAÇÕES DO WEBSITE
# INSERT INTO website.Configuracao VALUES ('padrao', '');

-- INCLUIR OS TIPOS DE INFORMAÇÕES DE CONTATO MAIS USADOS
INSERT INTO website.InformacaoContatoTipo (nome, prefixo, rede_social) VALUES
    ('Telefone', NULL, 0),
    ('Celular', NULL, 0),
    ('Endereço', NULL, 0),
    ('Email', '@', 0),
    ('Facebook', 'https://facebook.com/', 1),
    ('Instagram', 'https://instagram.com/', 1),
    ('Twitter', 'https://twitter.com/', 1),
    ('YouTube', NULL, 1),
    ('Skype', NULL, 0);


INSERT INTO website.AssuntoContato (descricao, cor, email) values
    ('Elogio', '#7DC34C', null),
    ('Reclamação', '#e76b33', null),
    ('Outros', '#E8E8E8', null);

-- ADICIONAR AS INFORMAÇÕES INSTITUCIONAIS PADRÃO NO IDIOMA br (PT-BR)
# INSERT INTO dlx_websitedlx_institucional (instit_idioma, instit_texto, instit_resumo) VALUES
#     (
#         'br',
#         '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
#         '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
#     );
