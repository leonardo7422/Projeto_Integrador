<?php
	require_once("../classeLayout/classeCabecalhoHTML.php");
	require_once("cabecalho.php");
	require_once("../classeLayout/classeTabela.php");
	require_once("classeControllerBD.php");



	
	require_once("conexao.php");
	
	require_once("configuracoes_listar.php");
	
	if($_GET["t"]=="ator"){
		require_once("form_ator.php");
	}
	if($_GET["t"]=="classificacao"){
		require_once("form_classificacao.php");
	}
	if($_GET["t"]=="diretor"){
		require_once("form_diretor.php");
	}
	if($_GET["t"]=="genero"){
		require_once("form_genero.php");
	}
	if($_GET["t"]=="cidade"){
		require_once("form_cidade.php");
	}

	if($_GET["t"]=="lista_desejo"){
		require_once("form_lista_desejo.php");
	}
	
	$c = new ControllerBD($conexao);
	
	$r = $c->selecionar($colunas,$t,null,null," LIMIT 0,5");
	
	while($linha = $r->fetch(PDO::FETCH_ASSOC)){
		$matriz[] = $linha;
	}
	
	$t = new Tabela($matriz,$t[0][0]);
	$t->exibe();




?>