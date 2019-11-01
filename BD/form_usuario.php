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
		$tabelas[0][0]="USUARIO";
		$tabelas[0][1]=null;
		$ordenacao = null;
		$condicao = $_POST["id"];
		$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
		$linha = $stmt->fetch(PDO::FETCH_ASSOC);
		$value_id_usuario = $linha["ID_USUARIO"];
		$value_cep = $linha["CEP"];
        $value_email = $linha["EMAIL"];
		$value_nome = $linha["NOME_USUARIO"];
        
		
		
		
        $action = "alterar.php?tabela=usuario";

		$disabled = true;
		
	}
	else{
		$disabled = false;
		$value_id_usuario = null;
		$value_cep = null;
		$value_email = null;
		$value_nome = null;
		

        $action = "insere.php?tabela=usuario";
	}
	


	$v = array("action"=>"insere.php?tabela=usuario","method"=>"post");
	$f = new Form($v);

	$v = array("type"=>"number","name"=>"ID_USUARIO","placeholder"=>"ID DO USUARIO...","value"=>$value_id_usuario, "disabled"=>$disabled);
	$f->add_input($v);

	if($disabled == true){
		array("type"=>"hidden","name"=>"ID_USUARIO");

	}
	$v = array("type"=>"text","name"=>"CEP","placeholder"=>"CEP DO USUARIO...","value"=>$value_cep);
    $f->add_input($v);

    $v = array("type"=>"text","name"=>"EMAIL","placeholder"=>"EMAIL DO USUARIO...","value"=>$value_email);
    $f->add_input($v);
    
    $v = array("type"=>"text","name"=>"NOME_USUARIO","placeholder"=>"NOME DO USUARIO...","value"=>$value_nome);
	$f->add_input($v);

	$v = array("type"=>"button","texto"=>"ENVIAR");
	$f->add_button($v);	
?>

<h3>Formulário - Inserir Usuário</h3>
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
				url: "insere.php?tabela=usuario",
				type: "post",
				data: {
						ID_USUARIO: $("input[name='ID_USUARIO']").val(),
						CEP: $("input[name='CEP']").val(),
						EMAIL: $("input[name='EMAIL']").val(),
						NOME_USUARIO: $("input[name='NOME_USUARIO']").val()
					},
					beforeSend: function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Usuario inserida com sucesso.");
							$("#status").css("color","purple");

						}
						else
						{
							$("#status").html("Usuario não inserida: Codigo já existente.");
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