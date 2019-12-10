<?php

if(isset($_GET["t"])){

	if($_GET["t"]=="ator"){
		
		$colunas = array(   "id_ator as ID","Nome_ator as 'Ator'");				
				$t[0][0] = "ator";
				$t[0][1] = null;
	}
	if($_GET["t"]=="classificacao"){
		
		$colunas = array(   "id_classificacao as ID","classificacao_indicativa as 'Classificacao'");				
				$t[0][0] = "classificacao";
				$t[0][1] = null;
	}

	if($_GET["t"]=="diretor"){
		
		$colunas = array(   "id_diretor as ID","nome_diretor as 'Diretor'");				
				$t[0][0] = "diretor";
				$t[0][1] = null;
	}

	if($_GET["t"]=="genero"){
		
		$colunas = array(   "id_genero as ID","descricao_genero as 'Gênero'");				
				$t[0][0] = "genero";
				$t[0][1] = null;
	}

	if($_GET["t"]=="cidade"){
		
		$colunas = array(   "id_cidade as ID","nome_cidade as 'Cidade'");				
				$t[0][0] = "cidade";
				$t[0][1] = null;
	}

	if($_GET["t"]=="filme"){
		
		$colunas = array(   "id_filme as 'ID'","diretor.id_diretor as 'diretor'","classificacao.id_classificacao as 'classificacao'","titulo","sinopse","ficha_tecnica","data_estreia","data_retirada");				
				$t[0][0] = "filme";
				$t[0][1] = "diretor";
				$t[1][0] = "filme";
				$t[1][1] = "classificacao";
	}
	
	if($_GET["t"]=="cinema"){
		
		$colunas = array(   "id_cinema as 'ID'","nome_cinema as 'Cinema'","cidade.id_cidade as 'Cidade'");				
				$t[0][0] = "cinema";
				$t[0][1] = "cidade";
				
	}
	
	
	if($_GET["t"]=="sessao"){
		
		$colunas = array(  "id_sessao as 'ID'","filme.id_filme as 'filme'","cinema.id_cinema as 'Cinema'","horario ","site_compra");				
				$t[0][0] = "sessao";
				$t[0][1] = "filme";
				$t[1][0] = "sessao";
				$t[1][1] = "cinema";
	}
	
		
	if($_GET["t"]=="genero_filme"){
		
		$colunas = array(  "id_genero_filme as 'ID'","filme.id_filme as 'Filme'","genero.id_genero ","genero.descricao_genero ","filme.titulo");				
				$t[0][0] = "genero_filme";
				$t[0][1] = "filme";
				$t[1][0] = "genero_filme";
				$t[1][1] = "genero";
	}
	
	
		
	if($_GET["t"]=="atores_filme"){
		
		$colunas = array(  "id_atores_filme as 'ID'","filme.id_filme ","ator.id_ator as 'ator'","ator.nome_ator ","filme.titulo");				
				$t[0][0] = "atores_filme";
				$t[0][1] = "filme";
				$t[1][0] = "atores_filme";
				$t[1][1] = "ator";
	}
	
	
	

	
}
?>