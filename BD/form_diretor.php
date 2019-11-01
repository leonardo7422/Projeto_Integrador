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
		$tabelas[0][0]="DIRETOR";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		$value_id_diretor = $linha["ID_DIRETOR"];
		$value_nome = $linha["NOME_DIRETOR"];

        
		
		
		
        $action = "alterar.php?tabela=diretor";

		$disabled = true;
		
	}
	else{
		$disabled = false;
		$value_id_diretor = null;
		$value_nome = null;
		

        $action = "insere.php?tabela=diretor";
	}
	


	$v = array("action"=>"insere.php?tabela=diretor","method"=>"post");
	$f = new Form($v);

	$v = array("type"=>"number","name"=>"ID_DIRETOR","placeholder"=>"ID DO DIRETOR...","value"=>$value_id_diretor, "disabled"=>$disabled);
	$f->add_input($v);

	if($disabled == true){
		array("type"=>"hidden","name"=>"ID_DIRETOR");

	}
	$v = array("type"=>"text","name"=>"NOME_DIRETOR","placeholder"=>"NOME DO DIRETOR...","value"=>$value_nome);
    $f->add_input($v);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>

<h3>Formulário - Inserir Diretor</h3>
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
				url: "insere.php?tabela=diretor",
				type: "post",
				data: {
						ID_DIRETOR: $("input[name='ID_DIRETOR']").val(),
						NOME_DIRETOR: $("input[name='NOME_DIRETOR']").val()			
					},
					beforeSend: function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Diretor inserida com sucesso.");
							$("#status").css("color","purple");

						}
						else
						{
							$("#status").html("Diretor não inserida: Codigo já existente.");
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