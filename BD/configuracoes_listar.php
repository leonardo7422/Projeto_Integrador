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

	


	
	
	
	
}
?>