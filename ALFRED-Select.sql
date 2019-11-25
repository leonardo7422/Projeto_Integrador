USE ALFRED;

-- Quais os filmes existente no historico de um determinado usuario, com a  respectiva nota, e comentario realizado pelo mesmo, 

select  filme.titulo, usuario.nome_usuario, avaliacao_filme.comentario, avaliacao_filme.nota
from avaliacao_filme
inner join historico
on avaliacao_filme.id_filme = historico.id_filme
inner join usuario 
on historico.id_usuario = usuario.id_usuario
inner join filme 
on historico.id_filme = filme.id_filme;


-- Quais os filmes que estão em cartaz
select titulo, ficha_tecnica, descricao_genero, nome_ator, nome_diretor
from 

-- Diz qual a data atual;
-- current_timestamp();

 SELECT * 
	FROM filme, genero_filme, genero, diretor, atores_filme, ator
	WHERE filme.id_filme = genero_filme.id_filme
	AND genero_filme.id_genero = genero.id_genero
	AND filme.id_diretor = diretor.id_diretor
	AND filme.id_filme = atores_filme.id_filme
    and atores_filme.id_ator = ator.id_ator
    and titulo like '%As Aventuras de Pi%';
    
    SELECT CLASSIFICACAO_INDICATIVA, TITULO
	FROM CLASSIFICACAO, FILME
	WHERE FILME.ID_CLASSIFICACAO = CLASSIFICACAO.ID_CLASSIFICACAO
	AND TITULO LIKE 'Coringa%';
    
select *
from usuario;
    
SELECT id_usuario
from usuario
where login = 'leo';

SELECT *
from filme;

select *
from lista_desejo;

SELECT *
from usuario
;

INSERT INTO lista_desejo VALUES ('1', '1');

select *
from lista_desejo;

DELETE FROM lista_desejo
WHERE ID_filme = 2;

SELECT * 
	FROM filme,ator,diretor,genero_filme
    where ator.id_ator = filme.id_ator
    and filme.id_filme = genero_filme.id_filme
    and diretor.id_diretor = filme.id_diretor;
    
    SELECT *
from usuario;

insert into usuario values( 2, 00000000, 'ADM', 'admin@123.com', 'Admin', 'admin', '202cb962ac59075b964b07152d234b70');


select * from usuario;

SELECT *
FROM USUARIO;


    SELECT NOME FROM USUARIO WHERE login = 123;

	SELECT ID_ATOR AS value, NOME_ATOR AS texto FROM ATOR ORDER BY NOME_ATOR;


