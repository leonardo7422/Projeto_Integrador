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
		$tabelas[0][0]="genero";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		$value_id_genero = $linha["ID_GENERO"];
		$value_desc_genero = $linha["DESCRICAO_GENERO"];

        
		
		
		
        $action = "alterar.php?tabela=genero";

		$disabled = true;
		
	}
	else{
		$disabled = false;
		$value_id_genero = null;
		$value_desc_genero = null;
		

        $action = "insere.php?tabela=genero";
	}
	


	$v = array("action"=>"insere.php?tabela=genero","method"=>"post");
	$f = new Form($v);

	$v = array("type"=>"number","name"=>"ID_GENERO","placeholder"=>"ID DO GÊNERO...","value"=>$value_id_genero, "disabled"=>$disabled);
	$f->add_input($v);

	if($disabled == true){
		array("type"=>"hidden","name"=>"ID_GENERO");

	}
	$v = array("type"=>"text","name"=>"DESCRICAO_GENERO","placeholder"=>"GÊNERO ...","value"=>$value_desc_genero);
    $f->add_input($v);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>

<h3>Formulário - Inserir Gênero (Filme)</h3>
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
				url: "insere.php?tabela=genero",
				type: "post",
				data: {
						ID_GENERO: $("input[name='ID_GENERO']").val(),
						DESCRICAO_GENERO: $("input[name='DESCRICAO_GENERO']").val()			
					},
					beforeSend: function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Gênero inserido com sucesso.");
							$("#status").css("color","purple");

						}
						else
						{
							$("#status").html("Gênero não inserido: Codigo já existente.");
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