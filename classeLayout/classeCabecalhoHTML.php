<?php
	class CabecalhoHTML{

		private $menu;

		public function exibe(){
			echo "<!DOCTYPE html>
				  <html>
				     <head>
						<meta charset='utf-8' />
						<style>
							select, textarea, input{margin:5px;}							
						</style>
						<script src='JS/jquery-3.4.1.min.js'></script>
					 </head>
					 <body>
					 <nav>
					 <b><a href='index.php'></br>Filmes<a></br></b> <br />
					 <b>Listar:</b> <br />
			";
			if($this->menu!=null){
				foreach($this->menu as $tabela=>$texto){
					echo "| <a href='listar.php?t=$tabela'>$texto</a> ";
				}
				echo "<br /><br />
					  <b>Cadastrar:</b> <br />";
				foreach($this->menu as $tabela=>$texto){
					echo "| <a href='form_$tabela.php'>$texto</a>";
				}
				
				echo "</nav>
				<hr />
				</body>";
				}
		}
		
		public function add_menu($tabela){
			$this->menu = $tabela;
		}
		
		
	}
?>