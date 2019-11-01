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
		$tabelas[0][0]="cinema";
		$tabelas[0][1]=null;
		$ordenacao=null;
		$condicao = $_POST["id"];


		$stmt = $c->selecionar($colunas, $tabelas, $ordenacao, $condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$value_id_cinema = $linha["ID_CINEMA"];
		$value_nome_cinema = $linha["NOME_CINEMA"];
		$value_id_cidade = $linha["ID_CIDADE"];
		
		$disabled = true;
		$action = "altera.php?tabela=cinema";
	}else{

		$action = "insere.php?tabela=cinema";
		$value_id_cinema = null;
		$value_nome_cinema = null;
		$value_id_cidade= null;

		$disabled = false;
	}


	//seleção dos valores que irão criar o <select>
	$select = "SELECT ID_CIDADE AS value, NOME_CIDADE AS texto FROM CIDADE ORDER BY NOME_CIDADE";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz[] = $linha;
	}	
	//______________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_CINEMA","placeholder"=>"ID DO CINEMA...","value"=>$value_id_cinema);
	$f->add_input($v);
	if($disabled == true){
		array("type"=>"hidden", "name"=>"ID_CINEMA", "placeholder"=>"ID DO CINEMA");
	}
	$v = array("type"=>"text","name"=>"NOME_CINEMA","placeholder"=>"NOME DO CINEMA...", "value"=>$value_nome_cinema);
	$f->add_input($v);
	
	$v = array("name"=>"ID_CIDADE", "selected"=>$value_id_cidade);
	$f->add_select($v,$matriz);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Cinema</h3>
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
				url: "insere.php?tabela=cinema",
				type: "post",
				data:
					{
					ID_CINEMA: $("input[name='ID_CINEMA']").val(),
					NOME_CINEMA: $("input[name='NOME_CINEMA']").val(),
					ID_CIDADE: $("select[name='ID_CIDADE'").val()
					},
				beforeSend: function(){
					$("button").attr("disabled", true);
				},
				success:function(d){
					$("button").attr("disabled", false);
						
						if(d=="1"){
							$("#status").html("Cinema inserido com sucesso");
							$("#status").css("color", "green");
						}
						else{
							$("#status").html("Cinema não inserido: Codigo ja existe");
							$("#status").css("color", "red");
						}
					

					}
			});

		});
	});
</script>
