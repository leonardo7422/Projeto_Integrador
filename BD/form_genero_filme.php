<?php

    require_once("../classeForm/classeSelect.php");

	require_once("../classeForm/classeInput.php");
	require_once("../classeForm/classeOption.php");
	require_once("../classeForm/classeSelect.php");
	require_once("../classeForm/classeForm.php");
	require_once("../classeForm/classeButton.php");


if(isset($_POST["id"])){
	
	require_once("classeControllerBD.php");

	$c = new ControllerBD($conexao);
	$colunas=array("*");
	$tabelas[0][0]="genero_filme";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$value_id_genero_filme = $linha["ID_GENERO_FILME"];
	$select_id_filme = $linha["ID_FILME"];
    $select_id_genero = $linha["ID_GENERO"];
    
	$action = "altera.php?tabela=genero_filme";
	}
else{
    $action = "insere.php?tabela=genero_filme";
	
	
    $value_id_genero_filme ="";
    $select_id_filme ="";
    $select_id_genero="";
   }

//___________________________________________________________________________________
    
	$select = "SELECT ID_FILME AS value, TITULO AS texto FROM FILME ORDER BY TITULO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_filme[] = $linha;
	}	

	$select = "SELECT ID_GENERO AS value , DESCRICAO_GENERO AS texto FROM GENERO ORDER BY DESCRICAO_GENERO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
    

	while($linha=$stmt->fetch()){
		$matriz_genero[] = $linha;
    }	
    
//_________________________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
    
	$v = array("type"=>"number","name"=>"ID_GENERO_FILME","placeholder"=>"ID DO GENERO_FILME...","value"=>$value_id_genero_filme);
	$f->add_input($v);

    $v = array("name"=>"ID_FILME","label"=>" Filme","selected"=>$select_id_filme);
    $f->add_select($v,$matriz_filme);
    
    
    $v = array("name"=>"ID_GENERO","label"=>"genero","selected"=>$select_id_genero);
    $f->add_select($v,$matriz_genero);
    

	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir genero de filme </h3>
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
				data: {tabela: "genero_filme"},
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
						tabela: "genero_filme" 
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
									0:{0:"genero_filme",1:"filme"},
                                    1:{0:"genero_filme",1:"genero"}
								},
						colunas:{0:"id_genero_filme",1:"id_filme",2:"id_genero"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
						tr += "<td>"+matriz[i].id_genero_filme+"</td>";
                        tr += "<td>"+matriz[i].id_filme+"</td>";
                        tr += "<td>"+matriz[i].id_genero+"</td>";
						
						tr += "<td><button value='"+matriz[i].id_genero_filme+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_genero_filme+"' class='alterar'>Alterar</button></td>";
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
				data: {id: id_alterar, tabela: "genero_filme"},
				success: function(dados){
					$("input[name='ID_GENERO_FILME']").val(dados.ID_GENERO_FILME);
					$("select[name='ID_FILME']").val(dados.ID_FILME);
					$("select[name='ID_GENERO']").val(dados.ID_GENERO);
					
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=genero_filme",
					type: "post",
					data: {

						ID_GENERO_FILME: $("input[name='ID_GENERO_FILME']").val(),	
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_GENERO: $("select[name='ID_GENERO']").val()
                    
					},
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("genero de filme  Alterado com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");

							$("input[name='ID_GENERO_FILME']").val("");
                            $("select[name='ID_FILME']").val("");
                            $("select[name='ID_GENERO']").val("");
                           paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("genero de filme Não Alterado! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=genero_filme",
				type: "post",
				data: {

						ID_GENERO_FILME: $("input[name='ID_GENERO_FILME']").val(),
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_GENERO: $("select[name='ID_GENERO']").val()
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Genero de filme inserido com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("Genero de filme Não inserido! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>