USE ALFRED;
-- tabelas Existentes

select * from ator;
select * from atores_filme;
select * from avaliacao;
select * from cidade;
select * from cinema;
select * from classificacao;
select * from diretor;
select * from filme;
select * from genero;
select * from genero_filme;
select * from historico;
select * from lista_desejo;
select * from sessao;
select * from usuario;


-- Quais os filmes existente no historico de um determinado usuario, com sua respectiva nota
SELECT 
    filme.titulo,
    usuario.nome,
    avaliacao.nota
FROM
   historico 
        INNER JOIN
    usuario ON historico.id_usuario = usuario.id_usuario
        INNER JOIN
    filme ON historico.id_filme = filme.id_filme
	inner join
		avaliacao on avaliacao.id_filme = filme.id_filme;

-- Quais os filmes que estão em cartaz
SELECT DISTINCT
    CURRENT_TIMESTAMP(),
    filme.titulo,
    filme.ficha_tecnica,
    genero.descricao_genero,
    diretor.nome_diretor
FROM
    atores_filme
        INNER JOIN
    ator ON atores_filme.id_ator = ator.id_ator
        INNER JOIN
    filme ON atores_filme.id_filme = filme.id_filme
        INNER JOIN
    diretor ON filme.id_diretor = diretor.id_diretor
        INNER JOIN
    classificacao ON filme.id_classificacao = classificacao.id_classificacao
        INNER JOIN
    genero_filme ON genero_filme.id_filme = filme.id_filme
        INNER JOIN
    genero ON genero_filme.id_genero = genero.id_genero
WHERE
    CURRENT_TIMESTAMP() BETWEEN data_estreia AND data_retirada;



-- Quais as avaliações geral de cada filme
SELECT 
    filme.titulo, AVG(nota) AS 'avaliações'
FROM
    avaliacao
        INNER JOIN
    filme ON avaliacao.id_filme = filme.id_filme
GROUP BY titulo;

-- Quais filmes serão transmitidos em determinada sessao, localizado em sua respectiva  cidade

SELECT 
    id_sessao,
    site_compra,
    cinema.nome_cinema,
    horario,
    filme.titulo,
    nome_cinema,
    titulo,
    cidade.nome_cidade
FROM
    sessao
        INNER JOIN
    filme ON sessao.id_filme = filme.id_filme
        INNER JOIN
    cinema ON sessao.id_cinema = cinema.id_cinema
        INNER JOIN
    cidade ON cinema.id_cidade = cidade.id_cidade;
    
    
-- Quais os filmes que estão na lista de desejo de um determinado usuario, e os horarios das sessao determinado filme
SELECT nome_usuario, filme.titulo, sessao.horario, site_compra, classificacao_indicativa, nome_cinema, nome_cidade
from usuario, filme, sessao, lista_desejo, classificacao, cinema, cidade
where usuario.id_usuario = lista_desejo.id_usuario
and lista_desejo.id_filme = sessao.id_filme
and sessao.id_filme = filme.id_filme
and sessao.id_cinema = cinema.id_cinema
and cinema.id_cidade = cidade.id_cidade
and filme.id_classificacao = classificacao.id_classificacao;
  
-- Dados de um determinado Login

SELECT *
from lista_desejo, usuario, filme, sessao, cinema, cidade, classificacao
where usuario.id_usuario = lista_desejo.id_usuario
and lista_desejo.id_filme = filme.id_filme
and filme.id_filme = sessao.id_filme
and sessao.id_cinema = cinema.id_cinema
and cinema.id_cidade = cidade.id_cidade
and classificacao.id_classificacao = filme.id_classificacao
and usuario.id_usuario = 2;