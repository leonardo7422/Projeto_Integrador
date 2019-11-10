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


