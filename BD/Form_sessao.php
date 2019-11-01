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
		$colunas=array("ID_SESSAO", "SITE_COMPRA","HORARIO", "ID_CIDADE" );
		$tabelas[0][0]="SESSAO";
		$tabelas[0][1]=null;
		$ordenacao=null;
		$condicao = $_POST["ID"];


		$stmt = $c->selecionar($colunas, $tabelas, $ordenacao, $condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$value_id_sessao = $linha["ID_SESSAO"];
		$value_site_compra = $linha["SITE_COMPRA"];
        $value_horario = $linha["HORARIO"];
        $value_id_cidade = $linha["ID_CIDADE"];
		
		$disabled = true;
		$action = "altera.php?tabela=SESSAO";
	}else{

		$action = "insere.php?tabela=SESSAO";
		
		$value_id_sessao = null;
		$value_site_compra = null;
        $value_horario = null;
        $value_id_cidade = null;
		

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
	
	$v = array("type"=>"text","name"=>"ID_SESSAO","placeholder"=>"ID SESSAO...","value"=>$value_id_sessao);
	$f->add_input($v);
	if($disabled == true){
		array("type"=>"hidden", "name"=>"ID_SESSAO", "placeholder"=>"ID SESSAO");
	}
	$v = array("type"=>"text","name"=>"SITE_COMPRA","placeholder"=>"SITE_COMPRA", "value"=>$value_site_compra);
    $f->add_input($v);
    
	$v = array("type"=>"text","name"=>"HORARIO","placeholder"=>"HORARIO", "value"=>$value_horario);
    $f->add_input($v);

	$v = array("name"=>"ID_CIDADE", "selected"=>$value_id_cidade);
	$f->add_select($v,$matriz);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir SESSÃO</h3>
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
				url: "insere.php?tabela=SESSAO",
				type: "post",
				data:
					{ID_SESSAO: $("input[name='ID_SESSAO']").val(),
					SITE_COMPRA: $("input[name='SITE_COMPRA']").val(),
					HORARIO: $("select[name='HORARIO'").val(),
                    ID_CIDADE: $("select[name='ID_CIDADE'").val(),
					},
				beforeSend: function(){
					$("button").attr("disabled", true);
				},
				success:function(d){
					$("button").attr("disabled", false);
						
						if(d=="1"){
							$("#status").html("Sessão inserida com sucesso");
							$("#status").css("color", "green");
						}
						else{
							$("#status").html("Sessão não inserida: Codigo ja existe");
							$("#status").css("color", "red");
						}
					

					}
			});

		});
	});
</script>
