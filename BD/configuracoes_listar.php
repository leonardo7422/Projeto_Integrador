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

	else if($_GET["t"]=="regiao"){
		
		$colunas = array(   "id_regiao as ID","Nome_regiao as 'Região'");				
				$t[0][0] = "regiao";
				$t[0][1] = null;
	}
	
	else if($_GET["t"]=="pais"){
		
		$colunas = array(   "id_pais as ID",
									"Nome_pais as 'País'",
									"Nome_regiao as 'Região'");				
				$t[0][0] = "pais";
				$t[0][1] = "regiao";
	}
	
	else if($_GET["t"]=="localizacao"){
		
		$colunas = array(   "id_localizacao as ID",
									"ENDERECO as 'ENDEREÇO'",
									"CEP as 'CEP'",
									"CIDADE as 'CIDADE'",
									"ESTADO as 'ESTADO'",
									"NOME_PAIS as 'PAÍS'",
									"NOME_REGIAO as 'REGIÃO'"
									);				
				$t[0][0] = "localizacao";
				$t[0][1] = "pais";
				$t[1][0] = "pais";
				$t[1][1] = "regiao";
	}
	
	else if($_GET["t"]=="funcao"){
		
		$colunas = array(   "id_funcao as ID",
							"titulo_funcao as 'Função'",
							"salario_minimo as 'Salário Mínimo'",
							"salario_maximo as 'Salário Máximo'");				
				$t[0][0] = "funcao";
				$t[0][1] = null;
	}
	
	else if($_GET["t"]=="funcionario"){
		
		$colunas = array(  "funcionario.id_funcionario as ID",						   
							"funcionario.nome as 'NOME'",
							"funcionario.sobrenome as 'SOBRENOME'",
							"funcionario.EMAIL as 'EMAIL'",
							"funcionario.TELEFONE as 'TELEFONE'",
							"funcionario.DATA_CONTRATACAO as 'DATA CONTRATAÇÃO'",
							"funcionario.SALARIO as 'SALÁRIO'",
							"funcionario.COMISSAO as 'COMISSÃO'",
							"funcao.TITULO_FUNCAO as 'FUNÇÃO'",
							"gerente.nome as 'NOME GERENTE'"
							);				
				$t[0][0] = "funcionario";
				$t[0][1] = "gerente";
				$t[1][0] = "funcionario";
				$t[1][1] = "funcao";
	}	


	else if($_GET["t"]=="departamento"){
			$colunas = array(   "id_departamento as ID",
									"Nome_Departamento AS 'Nome do Departamento'",
									"Endereco as 'Endereço'",
									"CEP",
									"Cidade",
									"Estado",
									"Nome_pais as 'País'",
									"Nome_regiao as 'Região'");
				
				$t[0][0] = "departamento";
				$t[0][1] = "localizacao";
				$t[1][0] = "localizacao";
				$t[1][1] = "pais";
				$t[2][0] = "pais";
				$t[2][1] = "regiao";
	}
	
}
?>