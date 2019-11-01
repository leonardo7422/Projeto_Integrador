<?php

	$c = new CabecalhoHTML();
	$v = array(		
		"usuario"=>"Usuário",	
		"ator"=>"Ator",
		"diretor"=>"Diretor",
		"genero"=>"Gênero",
		"filme"=>"Filme",
		"sessao"=>"Sessão",
		"classificacao"=>"Classificação",
		"cinema"=>"Cinema",
		"cidade"=>"Cidade"
				);
				
	$c->add_menu($v);
	$c->exibe();

?>