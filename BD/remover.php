<?php
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	include("conexao.php");
	include("classeControllerBD.php");
	$ctrl = New ControllerBD($conexao);
	$ctrl->remover($_POST["id"],$_POST["tabela"]);

?>
<hr />
<a href='form_<?=$_POST["tabela"];?>.php'>Voltar Para o Formulario</a>
</body>
</html>