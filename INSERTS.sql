USE ALFRED;

INSERT INTO CLASSIFICACAO VALUES (100, '18');
INSERT INTO CLASSIFICACAO VALUES (200, '16');
INSERT INTO CLASSIFICACAO VALUES (300, '14');
INSERT INTO CLASSIFICACAO VALUES (400, '10');
INSERT INTO CLASSIFICACAO VALUES (500, 'LIVRE');


INSERT INTO  ATOR VALUES (1, "Joaquin Phoenix");
INSERT INTO  ATOR VALUES (2, "Chris Pratt");
INSERT INTO  ATOR VALUES (3, "Scarlett Johansson");
INSERT INTO  ATOR VALUES (4, "Suraj Sharma");
       
INSERT INTO  DIRETOR VALUES (10, "Todd Phillips");
INSERT INTO  DIRETOR VALUES (20, "Spike Jonze");
INSERT INTO  DIRETOR VALUES (30, "Quentin Tarantino");
INSERT INTO  DIRETOR VALUES (40, "Darren Aronofsky");


INSERT INTO  FILME VALUES (1, 10, 100, 'Coringa', 'O comediante falido Arthur Fleck encontra violentos bandidos pelas ruas de Gotham City. 
												   Desconsiderado pela sociedade, Fleck começa a ficar louco e se transforma no criminoso conhecido como Coringa.',
												   'Duração: 122 min', '2019-10-10', '2020-1-10');

INSERT INTO  FILME VALUES (2, 20, 200, 'Her', 'Em Los Angeles, o escritor solitário Theodore desenvolve uma relação de amor especial com o novo sistema operacional do seu computador. 
											   Surpreendentemente, ele acaba se apaixonando pela voz deste programa, uma entidade intuitiva e sensível, chamada Samantha.', 
                                               'Duração: 120 min', '2019-12-09', '2020-2-10');
       
INSERT INTO  FILME VALUES (3, 40, 300, 'As Aventuras de Pi', 'Pi e sua família decidem ir para o Canadá depois de fechar o zoológico da família. 
															  A embarcação deles naufraga, e o jovem sobrevive junto com alguns animais, incluindo um temível tigre de Bengala, com o qual desenvolve uma ligação.', 
                                                              'Duração: 130 min', '2019-11-10', '2020-1-20');


INSERT INTO ATORES_FILME VALUES  (1,1, 1);
INSERT INTO ATORES_FILME VALUES  (2,1, 2);
INSERT INTO ATORES_FILME VALUES  (3,2, 3);
INSERT INTO ATORES_FILME VALUES  (4,3, 4);

INSERT INTO USUARIO VALUES( 2, 00000000, 'ADM', 'admin@123.com', 'Admin', 'admin', '202cb962ac59075b964b07152d234b70');
INSERT INTO USUARIO VALUES( 1, 00000000, 'USUARIO', 'leo@123.com', 'Leonardo', 'leo', '202cb962ac59075b964b07152d234b70');


INSERT INTO LISTA_DESEJO VALUES (1, 1);
INSERT INTO LISTA_DESEJO VALUES (1, 2);


INSERT INTO HISTORICO VALUES (1, 3);


INSERT INTO AVALIACAO VALUES (1,3, 5);
INSERT INTO AVALIACAO VALUES (1,2,3);

     
INSERT INTO  GENERO VALUES (1000, "Comédia");
INSERT INTO  GENERO VALUES (2000, "Ação");
INSERT INTO  GENERO VALUES (3000, "Suspense");
INSERT INTO  GENERO VALUES (4000, "Drama");
INSERT INTO  GENERO VALUES (5000, "Romance");
INSERT INTO  GENERO VALUES (6000, "Ficção Científica");
 
INSERT INTO  GENERO_FILME VALUES (1,1, 1000);
INSERT INTO  GENERO_FILME VALUES (2,2, 5000);
INSERT INTO  GENERO_FILME VALUES (3,3, 4000);
 
INSERT INTO  CIDADE VALUES  (26, 'Araraquara');
INSERT INTO  CIDADE VALUES (27, 'São Carlos');
INSERT INTO  CIDADE VALUES (28, 'Ribeirão Preto');
INSERT INTO  CIDADE VALUES (29, 'São Paulo');
            
INSERT INTO  CINEMA VALUES  (200, 'Moviecom Araraquara', 26);
INSERT INTO  CINEMA VALUES  (201, 'Cinemark',  27);
INSERT INTO  CINEMA VALUES  (202, 'Cine Movie', 28);
INSERT INTO  CINEMA VALUES  (203, 'Telecine', 29);
    
INSERT INTO  SESSAO VALUES  (2990, 'https://www.ingresso.com/araraquara/home', '19:30:00', 200, 1);
INSERT INTO  SESSAO VALUES  (2991, 'https://www.ingresso.com/sao-carlos/home', '20:00:00', 201, 2);
INSERT INTO  SESSAO VALUES  (2992, 'https://www.ingresso.com/ribeirao-preto/home', '15:30:00', 202, 3);
INSERT INTO  SESSAO VALUES  (2993, 'https://www.ingresso.com/sao-paulo/home', '12:00:00', 203, 3);
            









