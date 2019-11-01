<?php

if(isset($_GET["t"])){
	if($_GET["t"]=="usuario"){
		
		$colunas = array(   "id_usuario as ID",
							"Nome_Usuario as 'Nome do Usuário'",
							"cep as 'CEP'",
							"email as 'EMAIL'"
							
							
							
						
								);				
				$t[0][0] = "usuario";
				$t[0][1] = null;
	}

	else if($_GET["t"]=="ator"){
		
		$colunas = array(   "id_ator as ID",
							"nome_ator as 'Nome do Ator'"

							
							
							
						
								);				
				$t[0][0] = "ator";
				$t[0][1] = null;
	}

	else if($_GET["t"]=="diretor"){
		
		$colunas = array(   "id_diretor as ID",
							"nome_diretor as 'Nome do Diretor'"

							
							
							
						
								);				
				$t[0][0] = "diretor";
				$t[0][1] = null;
	}

	else if($_GET["t"]=="genero"){
		
		$colunas = array(   "id_genero as ID",
							"descricao_genero as 'Gênero'"

							
							
							
						
								);				
				$t[0][0] = "genero";
				$t[0][1] = null;
	}

	else if($_GET["t"]=="filme"){
		
		$colunas = array(   "filme.id_filme as ID",
							"titulo as 'Nome do Filme'",
							"Nome_ator as 'Nome do Ator'",
							"Nome_diretor as 'Nome do Diretor'"
					
							

							
							
							
						
								);				
								$t[0][0] = "filme";
								$t[0][1] = "ator";
								$t[1][0] = "filme";
								$t[1][1] = "diretor";
	}

	else if($_GET["t"]=="sessao"){
		
		$colunas = array(   "id_sessao as ID",
							"site_compra as 'Site de Venda do Ingresso'",
							"horario as 'Horario da Sessão'",
							"nome_cinema as 'Nome do Cinema'"			
						
								);				
				$t[0][0] = "sessao";
				$t[0][1] = "cinema";				
	}

	else if($_GET["t"]=="cinema"){
		
		$colunas = array(   "id_cinema as ID",
							"nome_cinema as 'Nome do Cinema'",
							"nome_cidade as 'Nome da Cidade'"			
						
								);				
				$t[0][0] = "cinema";
				$t[0][1] = "cidade";				
	}

	else if($_GET["t"]=="cidade"){
		
		$colunas = array(   "id_cidade as ID",
							"nome_cidade as 'Nome do Cinema'"
							
						
								);				
				$t[0][0] = "cidade";
				$t[0][1] = null;				
	}

	else if($_GET["t"]=="classificacao"){
		
		$colunas = array(   "id_classificacao as ID",
							"classificacao_indicativa as 'Classificacao em Anos'",
							"titulo as 'Nome do Filme'"			
						
								);				
				$t[0][0] = "classificacao";
				$t[0][1] = "filme";				
	}

	
	
	
}
?>