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
	if(isset($_POST["ID"])){

		require_once("classeControllerBD.php");

		$c = new ControllerBD($conexao);
		$colunas=array("ID_CLASSIFICAO", "CLASSIFICACAO_INDICATIVA","ID_FILME" );
		$tabelas[0][0]="CLASSIFICAO";
		$tabelas[0][1]=null;
		$ordenacao=null;
		$condicao = $_POST["ID"];


		$stmt = $c->selecionar($colunas, $tabelas, $ordenacao, $condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$value_id_classificacao = $linha["ID_CLASSIFICACAO"];
		$value_classificacao_indicativa = $linha["CLASSIFICACAO_INDICATIVA"];
		$value_id_filme = $linha["ID_FILME"];
		
		$disabled = true;
		$action = "altera.php?tabela=CLASSIFICACAO";
	}else{

		$action = "insere.php?tabela=CLASSIFICACAO";
		$value_id_classificacao = null;
		$value_nome_classificacao_indicativa = null;
		$value_id_filme = null;

		$disabled = false;
	}


	//seleção dos valores que irão criar o <select>
	$select = "SELECT ID_FILME AS value, TITULO AS texto FROM FILME ORDER BY TITULO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz[] = $linha;
	}	
	//______________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"text","name"=>"ID_CLASSIFICAO ","placeholder"=>"ID_CLASSIFICACAO...","value"=>$value_id_classificacao);
	$f->add_input($v);
	if($disabled == true){
		array("type"=>"hidden", "name"=>"ID_CLASSIFICACAO", "placeholder"=>"ID DA CLASSIFICACAO");
	}
	$v = array("type"=>"text","name"=>"CLASSIFICACAO_INDICATIVA","placeholder"=>"CLASSIFICACAO_INDICATIVA...", "value"=>$value_classificacao_indicativa);
	$f->add_input($v);
	
	$v = array("name"=>"ID_FILME", "selected"=>$value_id_filme);
	$f->add_select($v,$matriz);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir CLASSIFICACAO</h3>
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
				url: "insere.php?tabela=CLASSIFICACAO",
				type: "post",
				data:
					{ID_PAIS: $("input[name='ID_CLASSIFICACAO']").val(),
					NOME_PAIS: $("input[name='CLASSIFICACAO_INDICATIVA']").val(),
					ID_REGIAO: $("select[name='ID_FILME'").val()
					},
				beforeSend: function(){
					$("button").attr("disabled", true);
				},
				success:function(d){
					$("button").attr("disabled", false);
						
						if(d=="1"){
							$("#status").html("Classificação inserida com sucesso");
							$("#status").css("color", "green");
						}
						else{
							$("#status").html("Classificação não inserida: Codigo ja existe");
							$("#status").css("color", "red");
						}
					

					}
			});

		});
	});
</script>
