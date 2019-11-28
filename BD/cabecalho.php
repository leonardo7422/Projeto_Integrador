<?php

	$c = new CabecalhoHTML();
	$v = array(		
				"classificacao"=>"Classificação",
				"ator"=>"Ator",		
				"diretor"=>"Diretor",
				"genero"=>"Gênero",
				"lista_desejo"=>"Filmes Desejados",
				"historico"=>"Histórico",
				"cidade"=>"Cidade",
				"cinema"=>"Cinema",
				"sessao"=>"Sessão",
				"filme"=>"Filme",
				"usuario"=>"Usuario"
				
				
				);
				
	$c->add_menu($v);
	$c->exibe();

?>