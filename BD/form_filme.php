<?php

    require_once("../classeForm/classeSelect.php");

	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeButton.php");


if(isset($_POST["id"])){
	

	$c = new ControllerBD($conexao);
	$colunas=array("*");
	$tabelas[0][0]="filme";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
    $value_id_filme = $linha["ID_FILME"];
    $value_id_diretor= $linha["ID_DIRETOR"];
    $value_id_classificacao = $linha["ID_CLASSIFICACAO"];
    $value_titulo = $linha["TITULO"];
    $value_sinopse = $linha["SINOPSE"];
    $value_ficha_tecnica = $linha["FICHA_TECNICA"];
    $value_data_estreia = $linha["DATA_ESTREIA"];
    $value_data_retirada = $linha["DATA_RETIRADA"];
  
	$action = "altera.php?tabela=filme";
}
else{
    $action = "insere.php?tabela=filme";
    
    $value_id_filme ="";
    $value_id_diretor="";
    $value_id_classificacao ="";
    $value_titulo ="";
    $value_sinopse ="";
    $value_ficha_tecnica ="";
    $value_data_estreia ="";
    $value_data_retirada ="";
}

//___________________________________________________________________________________
    
	$select = "SELECT ID_DIRETOR AS value, NOME_DIRETOR AS texto FROM DIRETOR ORDER BY NOME_DIRETOR";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_diretor[] = $linha;
	}	

	$select = "SELECT ID_CLASSIFICACAO AS value , CLASSIFICACAO_INDICATIVA AS texto FROM CLASSIFICACAO ORDER BY CLASSIFICACAO_INDICATIVA";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
    

	while($linha=$stmt->fetch()){
		$matriz_classificacao[] = $linha;
    }	
    
//_________________________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_FILME","placeholder"=>"ID DO FILME...","value"=>$value_id_filme);
    $f->add_input($v);
    
    $v = array("name"=>"ID_DIRETOR","label"=>"Diretor do Filme","selected"=>$value_id_diretor);
    $f->add_select($v,$matriz_diretor);
    
    
    $v = array("name"=>"ID_CLASSIFICACAO","label"=>"Classificacao do Filme","selected"=>$value_id_classificacao);
    $f->add_select($v,$matriz_classificacao);
    

	$v = array("type"=>"text","name"=>"TITULO","placeholder"=>"TITULO...","value"=>$value_titulo);
    $f->add_input($v);
    
    $v = array("type"=>"text","name"=>"SINOPSE","placeholder"=>"SINOPSE...","value"=>$value_sinopse);
    $f->add_input($v);
    
	$v = array("type"=>"text","name"=>"FICHA_TECNICA","placeholder"=>"Ficha Tecnica...","value"=>$value_ficha_tecnica);
    $f->add_input($v);
    
    
	$v = array("type"=>"date","name"=>"DATA_ESTREIA","placeholder"=>"data de estreia...","value"=>$value_data_estreia);
    $f->add_input($v);
    
	$v = array("type"=>"date","name"=>"DATA_RETIRADA","placeholder"=>"Data retirada...","value"=>$value_data_retirada);
    $f->add_input($v);
    
	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Filme</h3>
<div id="status"></div>
<hr />
<?php
	$f->exibe();

?>
<script>

	pagina_atual = 0;
	//quando o documento estiver pronto...
	$(function(){
		
		carrega_botoes();
		
		function carrega_botoes(){
			
			$.ajax({
				url: "quantidade_botoes.php",
				type: "post",
				data: {tabela: "filme"},
				success: function(q){
					console.log(q);
					$("#botoes").html("");
					for(i=1;i<=q;i++){
						botao = " <button type='button' class='pg'>" + i + "</button>";
						$("#botoes").append(botao);
					}
				}
			});
		}
		
		$(document).on("click",".remover",function(){
			id_remover = $(this).val();
			$.ajax({
				url: "remover.php",
				type: "post",
				data: {
						id: id_remover,
						tabela: "filme" 
					  },
				success: function(d){					
					if(d=='1'){
						$("#status").html("Removido com sucesso");
						carrega_botoes();
						qtd = $("tbody tr").length;
						if(qtd=="1"){
							pagina_atual--;
						}
						paginacao(pagina_atual);
					}
				}
			});
		});
		
		$(document).on("click",".pg",function(){
			valor_botao = $(this).html();
			pagina_atual = valor_botao;
			paginacao(valor_botao);
		});
		
		function paginacao(b){
			$.ajax({
				url: "carrega_dados.php",
				type: "post",
				data: {
						tabelas:{
									0:{0:"filme",1:"diretor"},
                                    1:{0:"filme",1:"classificacao"}
								},
						colunas:{0:"id_filme",1:"id_diretor", 2:"id_classificacao",3:"titulo",4:"sinopse",5:"ficha_tecnica",6:"data_estreia",7:"data_retirada"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
						tr += "<td>"+matriz[i].id_filme+"</td>";
                        tr += "<td>"+matriz[i].id_diretor+"</td>";
                        tr += "<td>"+matriz[i].id_classificacao+"</td>";
                        tr += "<td>"+matriz[i].titulo+"</td>";
                        tr += "<td>"+matriz[i].sinopse+"</td>";
						tr += "<td>"+matriz[i].ficha_tecnica+"</td>";
                        tr += "<td>"+matriz[i].data_estreia+"</td>";
                        tr += "<td>"+matriz[i].data_retirada+"</td>";

						tr += "<td><button value='"+matriz[i].id_filme+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_filme+"' class='alterar'>Alterar</button></td>";
						tr += "</tr>";	
						$("tbody").append(tr);
					}
				}
			});
		}
		
		$(document).on("click",".alterar",function(){ 
			id_alterar = $(this).val();			
			$.ajax({
				url: "get_dados_form.php",
				type: "post",
				data: {id: id_alterar, tabela: "filme"},
				success: function(dados){
					$("input[name='ID_FILME']").val(dados.ID_FILME);
					$("select[name='ID_DIRETOR']").val(dados.ID_DIRETOR);
					$("select[name='ID_CLASSIFICACAO']").val(dados.ID_CLASSIFICACAO);
					$("input[name='TITULO']").val(dados.TITULO);
					$("input[name='SINOPSE']").val(dados.SINOPSE);
					$("input[name='FICHA_TECNICA']").val(dados.FICHA_TECNICA);
					$("input[name='DATA_ESTREIA']").val(dados.DATA_ESTREIA);
					$("input[name='DATA_RETIRADA']").val(dados.DATA_RETIRADA);
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=filme",
					type: "post",
					data: {
            
                        ID_FILME: $("input[name='ID_FILME']").val(),
                        ID_DIRETOR: $("select[name='ID_DIRETOR']").val(),
                        ID_CLASSIFICACAO: $("select[name='ID_CLASSIFICACAO']").val(),
                        TITULO: $("input[name='TITULO']").val(),
                        SINOPSE: $("input[name='SINOPSE']").val(),
                        FICHA_TECNICA: $("input[name='FICHA_TECNICA']").val(),
                        DATA_ESTREIA: $("input[name='DATA_ESTREIA']").val(),
                        DATA_RETIRADA: $("input[name='DATA_RETIRADA']").val()

					},
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Filme Alterado com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");

                            $("input[name='ID_FILME']").val("");
                            $("select[name='ID_DIRETOR']").val("");
                            $("select[name='ID_CLASSIFICACAO']").val("");
                            $("input[name='TITULO']").val("");
                            $("input[name='SINOPSE']").val("");
                            $("input[name='FICHA_TECNICA']").val("");
                            $("input[name='DATA_ESTREIA']").val("");
                            $("input[name='DATA_RETIRADA']").val("");
							paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("Filme Não Alterado! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=filme",
				type: "post",
				data: {
                        
                        ID_FILME: $("input[name='ID_FILME']").val(),
                        ID_DIRETOR: $("select[name='ID_DIRETOR']").val(),
                        ID_CLASSIFICACAO: $("select[name='ID_CLASSIFICACAO']").val(),
                        TITULO: $("input[name='TITULO']").val(),
                        SINOPSE: $("input[name='SINOPSE']").val(),
                        FICHA_TECNICA: $("input[name='FICHA_TECNICA']").val(),
                        DATA_ESTREIA: $("input[name='DATA_ESTREIA']").val(),
                        DATA_RETIRADA: $("input[name='DATA_RETIRADA']").val()

					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Filme inserido com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("Filme Não inserida! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>