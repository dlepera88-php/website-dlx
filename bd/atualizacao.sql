start transaction ;
alter table website.dlx_assuntos_contato rename to website.AssuntoContato;
alter table website.dlx_contatos_recebidos rename to website.ContatoRecebido;
alter table website.dlx_informacao_contato_tipo rename to website.InformacaoContatoTipo;
alter table website.dlx_informacao_contato rename to website.InformacaoContato;
alter table website.dlx_institucional rename to website.Institucional;

alter table website.AssuntoContato drop column publicado;
commit ;