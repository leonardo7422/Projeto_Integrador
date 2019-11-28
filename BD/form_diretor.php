<?php

	require_once("../classeForm/classeInput.php");
	
	require_once("../classeForm/classeForm.php");
	
	require_once("../classeForm/classeButton.php");

if(isset($_POST["id"])){
	$c = new ControllerBD($conexao);
	$colunas=array("*");
	$tabelas[0][0]="diretor";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	$value_id_diretor = $linha["ID_DIRETOR"];
	$value_nome_diretor = $linha["NOME_DIRETOR"];
	$action = "altera.php?tabela=diretor";
}
else{
	$action = "insere.php?tabela=diretor";
	$value_id_diretor="";
	$value_nome_diretor="";
}

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_DIRETOR","placeholder"=>"ID DO DIRETOR...","value"=>$value_id_diretor);
	$f->add_input($v);
	$v = array("type"=>"text","name"=>"NOME_DIRETOR","placeholder"=>"NOME DO DIRETOR...","value"=>$value_nome_diretor);
	$f->add_input($v);	
	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Diretor</h3>
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
				data: {tabela: "diretor"},
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
						tabela: "diretor" 
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
									0:{0:"diretor",1:null}
								},
						colunas:{0:"id_diretor",1:"nome_diretor"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
						tr += "<td>"+matriz[i].id_diretor+"</td>";
						tr += "<td>"+matriz[i].nome_diretor+"</td>";
						tr += "<td><button value='"+matriz[i].id_diretor+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_diretor+"' class='alterar'>Alterar</button></td>";
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
				data: {id: id_alterar, tabela: "diretor"},
				success: function(dados){
					$("input[name='ID_DIRETOR']").val(dados.ID_DIRETOR);
					$("input[name='NOME_DIRETOR']").val(dados.NOME_DIRETOR);
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=diretor",
					type: "post",
					data: {
						ID_DIRETOR: $("input[name='ID_DIRETOR']").val(),
						NOME_DIRETOR: $("input[name='NOME_DIRETOR']").val()
					 },
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Diretor Alterada com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");
							$("input[name='ID_DIRETOR']").val("");
							$("input[name='NOME_DIRETOR']").val("");
							paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("Diretor Não Alterada! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=diretor",
				type: "post",
				data: {
						ID_DIRETOR: $("input[name='ID_DIRETOR']").val(),
						NOME_DIRETOR: $("input[name='NOME_DIRETOR']").val()
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Diretor inserida com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("Diretor Não inserido! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>
</html>