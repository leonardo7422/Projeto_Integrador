<?php

	$c = new CabecalhoHTML();
	$v = array(		
				"classificacao"=>"Classificação",
				"ator"=>"Ator",		
				"diretor"=>"Diretor",
				"genero"=>"Gênero",
				"cidade"=>"Cidade",
				"filme"=>"Filme",
				"cinema"=>"Cinema",
				"sessao"=>"Sessão",
				"genero_filme"=>"Genero Filme",
				"atores_filme"=>"Atores Filme"				
				
				);
				
	$c->add_menu($v);
	$c->exibe();

?>