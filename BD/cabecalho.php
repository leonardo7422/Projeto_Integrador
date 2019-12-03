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
				"sessao"=>"Sessão"
				
				
				);
				
	$c->add_menu($v);
	$c->exibe();

?>