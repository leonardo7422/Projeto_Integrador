
DROP database if exists ALFRED;

CREATE DATABASE if not exists ALFRED;

 USE ALFRED;
 
 CREATE TABLE IF NOT EXISTS CLASSIFICACAO (
    ID_CLASSIFICACAO INT NOT NULL PRIMARY KEY,
    CLASSIFICACAO_INDICATIVA VARCHAR(10)
);
 CREATE TABLE IF NOT EXISTS ATOR (
    ID_ATOR INT NOT NULL PRIMARY KEY,
    NOME_ATOR VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS DIRETOR (
    ID_DIRETOR INT NOT NULL PRIMARY KEY,
    NOME_DIRETOR VARCHAR(50)
);

 CREATE TABLE IF NOT EXISTS FILME (
    ID_FILME INT NOT NULL PRIMARY KEY,
    ID_DIRETOR INT NOT NULL,
    ID_CLASSIFICACAO INT NOT NULL,
	TITULO VARCHAR(50),
    SINOPSE VARCHAR(1000),
    FICHA_TECNICA VARCHAR(100),
    DATA_ESTREIA DATE,
    DATA_RETIRADA DATE,
    FOREIGN KEY (ID_DIRETOR)
        REFERENCES DIRETOR (ID_DIRETOR)
        ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ID_CLASSIFICACAO)
        REFERENCES CLASSIFICACAO(ID_CLASSIFICACAO)
        ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS ATORES_FILME (
    ID_FILME INT NOT NULL,
    ID_ATOR INT NOT NULL,
    PRIMARY KEY(ID_FILME, ID_ATOR),
    FOREIGN KEY (ID_FILME)
        REFERENCES FILME(ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(ID_ATOR)
        REFERENCES ATOR(ID_ATOR)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS USUARIO (
	ID_USUARIO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CEP VARCHAR(9),
    ACESSO ENUM('usuario','adm '),
    EMAIL VARCHAR(50),
    NOME VARCHAR(50),
    LOGIN VARCHAR(50),
    SENHA VARCHAR(50)
    
);


CREATE TABLE IF NOT EXISTS LISTA_DESEJO (
	ID_USUARIO INT NOT NULL,
    ID_FILME INT NOT NULL,
    PRIMARY KEY(ID_USUARIO, ID_FILME),
    FOREIGN KEY (ID_USUARIO)
        REFERENCES USUARIO (ID_USUARIO)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_FILME)
        REFERENCES FILME (ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE
);




CREATE TABLE IF NOT EXISTS GENERO (
    ID_GENERO INT NOT NULL PRIMARY KEY,
    DESCRICAO_GENERO VARCHAR(50)
);


CREATE TABLE IF NOT EXISTS GENERO_FILME (
    ID_FILME INT NOT NULL,
    ID_GENERO INT NOT NULL,
    PRIMARY KEY (ID_FILME , ID_GENERO),
    FOREIGN KEY (ID_FILME)
        REFERENCES FILME (ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_GENERO)
        REFERENCES GENERO (ID_GENERO)
        ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS HISTORICO (
    ID_USUARIO INT NOT NULL,
    ID_FILME INT NOT NULL,
    PRIMARY KEY(ID_USUARIO, ID_FILME),
    FOREIGN KEY (ID_USUARIO)
        REFERENCES USUARIO (ID_USUARIO)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_FILME)
        REFERENCES FILME (ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AVALIACAO_FILME (
    ID_AVALIACAO INT NOT NULL PRIMARY KEY ,
	ID_FILME INT NOT NULL,
    COMENTARIO VARCHAR(50),
	NOTA INT,
    DATA DATE,
      FOREIGN KEY (ID_FILME)
        REFERENCES FILME(ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AVALIACAO_USUARIO (
    ID_USUARIO INT NOT NULL,
    ID_AVALIACAO INT NOT NULL,
    primary key(ID_USUARIO, ID_AVALIACAO),
    FOREIGN KEY (ID_USUARIO)
        REFERENCES USUARIO (ID_USUARIO)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_AVALIACAO)
        REFERENCES AVALIACAO_FILME(ID_AVALIACAO)
        ON UPDATE CASCADE ON DELETE CASCADE
);



CREATE TABLE IF NOT EXISTS CIDADE (
    ID_CIDADE INT NOT NULL PRIMARY KEY,
    NOME_CIDADE VARCHAR(50)
);


CREATE TABLE IF NOT EXISTS CINEMA (
    ID_CINEMA INT NOT NULL PRIMARY KEY,
    NOME_CINEMA VARCHAR(50),
    ID_CIDADE INT NOT NULL,
    FOREIGN KEY (ID_CIDADE)
        REFERENCES CIDADE (ID_CIDADE)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS SESSAO (
    ID_SESSAO INT NOT NULL PRIMARY KEY,
    SITE_COMPRA VARCHAR(100),
    HORARIO TIME,
    ID_CINEMA INT NOT NULL,
    ID_FILME INT ,
    FOREIGN KEY (ID_CINEMA)
        REFERENCES CINEMA (ID_CINEMA)
        ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ID_FILME)
        REFERENCES FILME(ID_FILME)
        ON UPDATE CASCADE ON DELETE CASCADE
);


SELECT *
FROM USUARIO;


    SELECT NOME FROM USUARIO WHERE login = 123;

	SELECT ID_ATOR AS value, NOME_ATOR AS texto FROM ATOR ORDER BY NOME_ATOR;
    

    
    insert into classificacao values (100, '18');
    insert into classificacao values (200, '16');
     insert into classificacao values (300, '14');
      insert into classificacao values (400, '12');
     insert into classificacao values (500, '10');
      insert into classificacao values (600, 'LIVRE');
      
	insert into ator values (1, "Joaquin Phoenix");
    	insert into ator values (2, "Chris Pratt");
        insert into ator values (3, "Scarlett Johansson");
        insert into ator values (4, "Suraj Sharma");
       
   
    
    insert into diretor values (10, "Todd Phillips");
    	insert into diretor values (20, "Spike Jonze");
        insert into diretor values (30, "Quentin Tarantino");
        insert into diretor values (40, "Darren Aronofsky");

    
    insert into genero values (1000, "Comédia");
    	insert into genero values (2000, "Ação");
        insert into genero values (3000, "Suspense");
        insert into genero values (4000, "Drama");
        insert into genero values (5000, "Romance");
        insert into genero values (6000, "Ficção Científica");
        
       
    
    insert into filme values (1, 10, 100, 'Coringa', 'O comediante falido Arthur Fleck encontra violentos bandidos pelas ruas de Gotham City. 
    Desconsiderado pela sociedade, Fleck começa a ficar louco e se transforma no criminoso conhecido como Coringa.', 'Duração: 122 min', '2019-10-10', '2019-11-10');
        insert into filme values (2, 20, 200, 'Her', 'Em Los Angeles, o escritor solitário Theodore desenvolve uma relação de amor especial com o novo sistema operacional do seu computador. 
        Surpreendentemente, ele acaba se apaixonando pela voz deste programa, uma entidade intuitiva e sensível, chamada Samantha.', 'Duração: 120 min', '2013-10-10', '2013-11-10');
        insert into filme values (3, 40, 200, 'As Aventuras de Pi', 'Pi e sua família decidem ir para o Canadá depois de fechar o zoológico da família. 
        A embarcação deles naufraga, e o jovem sobrevive junto com alguns animais, incluindo um temível tigre de Bengala, com o qual desenvolve uma ligação.', 'Duração: 130 min', '2010-5-10', '2013-7-20');
    
    
    insert into genero_filme values (1, 1000);
      	insert into genero_filme values (2, 5000);
        insert into genero_filme values (3, 4000);
        
             insert into atores_filme values (1, 1);
			insert into atores_filme values (1, 2);
			insert into atores_filme values (2, 3);
			insert into atores_filme values (3, 4);
    
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

