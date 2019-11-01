<?php

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	include("conexao.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeButton.php");
	require_once("../classeForm/classeForm.php");

	if(isset($_POST["id"])){
		require_once("classeControllerBD.php");
		$c = new ControllerBD($conexao);
		$colunas = array("*");
		$tabelas[0][0]="ator";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		$value_id_ator = $linha["ID_ATOR"];
		$value_nome = $linha["NOME_ATOR"];

        
		
		
		
        $action = "alterar.php?tabela=ator";

		$disabled = true;
		
	}
	else{
		$disabled = false;
		$value_id_ator = null;
		$value_nome = null;
		

        $action = "insere.php?tabela=ator";
	}
	


	$v = array("action"=>"insere.php?tabela=ator","method"=>"post");
	$f = new Form($v);

	$v = array("type"=>"number","name"=>"ID_ATOR","placeholder"=>"ID DO ATOR...","value"=>$value_id_ator, "disabled"=>$disabled);
	$f->add_input($v);

	if($disabled == true){
		array("type"=>"hidden","name"=>"ID_ATOR");

	}
	$v = array("type"=>"text","name"=>"NOME_ATOR","placeholder"=>"NOME DO ATOR...","value"=>$value_nome);
    $f->add_input($v);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>

<h3>Formulário - Inserir Ator</h3>
<div id="status"></div>

<hr />
<?php
	$f->exibe();

?>
<script>
 //quando o documento estiver pronto
 $(function(){

//definaa sa seguinte regra para o botão de envio
$("button").click(function(){
		$.ajax({
				url: "insere.php?tabela=ator",
				type: "post",
				data: {
						ID_ATOR: $("input[name='ID_ATOR']").val(),
						NOME_ATOR: $("input[name='NOME_ATOR']").val()			
					},
					beforeSend: function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Ator inserida com sucesso.");
							$("#status").css("color","purple");

						}
						else
						{
							$("#status").html("Ator não inserida: Codigo já existente.");
							$("#status").css("color","yellow");
						}
					}
		});
	});
 });

</script>
</body>
</html>
</html>