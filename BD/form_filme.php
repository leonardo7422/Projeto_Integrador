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
		$tabelas[0][0]="filme";
		$tabelas[0][1]="genero";
		$ordenacao = null;
		$condicao = $_POST["id"];
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		$value_id_filme = $linha["ID_FILME"];
		$value_id_ator = $linha["ID_ATOR"];
		$value_id_diretor = $linha["ID_DIRETOR"];
		$value_id_genero = $linha["ID_GENERO"];
		$value_titulo = $linha["TITULO"];
		$value_ficha_tecnica =   $linha["FICHA_TECNICA"];
		$value_data_estreia = $linha["DATA_ESTREIA"];
		$value_data_retirada = $linha["DATA_RETIRADA"];

		
		$action = "alterar.php?tabela=filme";

		$disabled = true;
		
	}
	else{
		$disabled = false;
        $value_id_filme = null;
		$value_id_ator =  null;
		$value_id_diretor =  null;
		$value_id_genero =  null;
		$value_titulo =  null;
		$value_ficha_tecnica =  null;
		$value_data_estreia =  null;
		$value_data_retirada =  null;

		$action = "insere.php?tabela=filme";			
	}
	
	
	$select = "SELECT ID_ATOR AS value, NOME_ATOR AS texto FROM ator ORDER BY NOME_ATOR";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_ator[] = $linha;
	}	

	$select = "SELECT ID_DIRETOR AS value, NOME_DIRETOR AS texto FROM diretor ORDER BY NOME_DIRETOR";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_diretor[] = $linha;
	}	

	$select = "SELECT ID_GENERO AS value, DESCRICAO_GENERO AS texto FROM genero ORDER BY DESCRICAO_GENERO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_genero[] = $linha;
	}	



	$v = array("action"=>"insere.php?tabela=filme","method"=>"post");
	$f = new Form($v);

	$v = array("type"=>"number","name"=>"ID_FILME","placeholder"=>"ID_FILME...","value"=>$value_id_filme, "disabled"=>$disabled);
	$f->add_input($v);

	if($disabled == true){
		array("type"=>"hidden","name"=>"ID_FILME","placeholder"=>"ID_FILME...");

    }
    
    $v = array("name"=>"ID_ATOR","label"=>"Ator do Filme","selected"=>$value_id_ator);
	$f->add_select($v,$matriz_ator);
	
	$v = array("name"=>"ID_DIRETOR","label"=>"Diretor do Filme","selected"=>$value_id_diretor);
	$f->add_select($v,$matriz_diretor);

	$v = array("name"=>"ID_GENERO","label"=>"Gênero do Filme","selected"=>$value_id_genero);
	$f->add_select($v,$matriz_genero);

	$v = array("type"=>"text","name"=>"TITULO","placeholder"=>"TÍTULO DO FILME...","value"=>$value_titulo);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"FICHA_TECNICA","placeholder"=>"FICHA TÉCNICA...", "value"=>$value_ficha_tecnica);
	$f->add_input($v);
	$v = array("type"=>"date","name"=>"DATA_ESTREIA","placeholder"=>"DATA DE ESTRÉIA DO FILME...","value"=>$value_data_estreia);
	$f->add_input($v);
	$v = array("type"=>"date","name"=>"DATA_RETIRADA","placeholder"=>"DATA DE RETIRADA DO FILME...","value"=>$value_data_retirada);
    $f->add_input($v);
    
	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>

<h3>Formulário - Inserir Filme</h3>
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
				url: "insere.php?tabela=filme",
				type: "post",
				data: {
						ID_FILME: $("input[name='ID_FILME']").val(),
						ID_ATOR: $("select[name='ID_ATOR']").val(),
						ID_DIRETOR: $("select[name='ID_DIRETOR']").val(),
						ID_GENERO: $("select[name='ID_GENERO']").val(),
						TITULO: $("input[name='TITULO']").val(),
						FICHA_TECNICA: $("input[name='FICHA_TECNICA']").val(),
						DATA_ESTREIA: $("input[name='DATA_ESTREIA']").val(),
						DATA_RETIRADA: $("input[name='DATA_RETIRADA']").val()
					},
					beforeSend: function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Filme inserido com sucesso.");
							$("#status").css("color","purple");

						}
						else
						{
							$("#status").html("Filme não inserido: Codigo já existente.");
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