<?php

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	
	require_once("../classeForm/InterfaceExibicao.php");
	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeButton.php");

	include("conexao.php");
	if(isset($_POST["id"])){

		require_once("classeControllerBD.php");

		$c = new ControllerBD($conexao);
		$colunas=array("*");
		$tabelas[0][0]="cidade";
		$tabelas[0][1]=null;
		$ordenacao=null;
		$condicao = $_POST["id"];


		$stmt = $c->selecionar($colunas, $tabelas, $ordenacao, $condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$value_id_cidade = $linha["ID_CIDADE"];
		$value_nome_cidade = $linha["NOME_CIDADE"];
		
		
		$disabled = true;
		$action = "altera.php?tabela=cidade";
	}else{

		$action = "insere.php?tabela=cidade";
		$value_id_cidade = null;
        $value_nome_cidade = null;
		$disabled = false;
	}

	//______________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_CIDADE","placeholder"=>"ID DA CIDADE...","value"=>$value_id_cidade);
	$f->add_input($v);
	if($disabled == true){
		array("type"=>"hidden", "name"=>"ID_CIDADE", "placeholder"=>"ID DA CIDADE");
	}
	$v = array("type"=>"text","name"=>"NOME_CIDADE","placeholder"=>"NOM1E DA CIDADE...", "value"=>$value_nome_cidade);
	$f->add_input($v);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Cidade</h3>
<div id="status"></div>
<hr />
<?php
	$f->exibe();

?>
<script>
	//Quando o documento estiver pronto
	$(function(){
		//defina a seguinte regra para o botao de envio
		$("button").click(function(){
			$.ajax({
				url: "insere.php?tabela=cidade",
				type: "post",
				data:
					{
					ID_CIDADE: $("input[name='ID_CIDADE']").val(),
					NOME_CIDADE: $("input[name='NOME_CIDADE']").val(),
					},
				beforeSend: function(){
					$("button").attr("disabled", true);
				},
				success:function(d){
					$("button").attr("disabled", false);
						
						if(d=="1"){
							$("#status").html("Cidade inserida com sucesso");
							$("#status").css("color", "green");
						}
						else{
							$("#status").html("Cidade não inserida: Codigo ja existe");
							$("#status").css("color", "red");
						}
					

					}
			});

		});
	});
</script>
