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

	if($_GET["t"]=="filme"){
		require_once("form_filme.php");
	}
	
	if($_GET["t"]=="cinema"){
		require_once("form_cinema.php");
	}
	
	if($_GET["t"]=="sessao"){
		require_once("form_sessao.php");
	}
	
	
	if($_GET["t"]=="genero_filme"){
		require_once("form_genero_filme.php");
	}
	
	
	if($_GET["t"]=="atores_filme"){
		require_once("form_atores_filme.php");
	}
	
	$c = new ControllerBD($conexao);
	
	$r = $c->selecionar($colunas,$t,null,null," LIMIT 0,5");
	

	$matriz = null;

	while($linha = $r->fetch(PDO::FETCH_ASSOC)){
		$matriz[] = $linha;
	}

	
	
	$t = new Tabela($matriz,$t[0][0]);
	$t->exibe();




?>