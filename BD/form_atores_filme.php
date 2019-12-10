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
	$tabelas[0][0]="atores_filme";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$value_id_atores_filme = $linha["ID_ATORES_FILME"];
	$select_id_filme = $linha["ID_FILME"];
    $select_id_ator = $linha["ID_ATOR"];
    
	$action = "altera.php?tabela=atores_filme";
}
else{
    $action = "insere.php?tabela=atores_filme";
	
	$value_id_atores_filme  = "";
    $select_id_filme ="";
    $select_id_ator="";
   }

//___________________________________________________________________________________
    
	$select = "SELECT ID_FILME AS value, TITULO AS texto FROM FILME ORDER BY TITULO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_filme[] = $linha;
	}	

	$select = "SELECT ID_ATOR AS value , NOME_ATOR AS texto FROM ATOR ORDER BY NOME_ATOR";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
    

	while($linha=$stmt->fetch()){
		$matriz_ator[] = $linha;
    }	
    
//_________________________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_ATORES_FILME","placeholder"=>"ID ATORES FILME...","value"=>$value_id_atores_filme);
	$f->add_input($v);
    
    $v = array("name"=>"ID_FILME","label"=>" Filme","selected"=>$select_id_filme);
    $f->add_select($v,$matriz_filme);
    
    
    $v = array("name"=>"ID_ATOR","label"=>"Ator","selected"=>$select_id_ator);
    $f->add_select($v,$matriz_ator);
    

	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Atores de filme </h3>
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
				data: {tabela: "atores_filme"},
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
						tabela: "atores_filme" 
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
									0:{0:"atores_filme",1:"filme"},
                                    1:{0:"atores_filme",1:"ator"}
								},
						colunas:{0:"id_atores_filme",1:"id_filme",2:"id_ator"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
                        tr += "<td>"+matriz[i].id_filme+"</td>";
                        tr += "<td>"+matriz[i].id_ator+"</td>";
						
						tr += "<td><button value='"+matriz[i].id_atores_filme+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_atores_filme+"' class='alterar'>Alterar</button></td>";
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
				data: {id: id_alterar, tabela: "atores_filme"},
				success: function(dados){
					
					$("input[name='ID_ATORES_FILME']").val(dados.ID_ATORES_FILME);
					$("select[name='ID_FILME']").val(dados.ID_FILME);
					$("select[name='ID_ATOR']").val(dados.ID_ATOR);
					
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=atores_filme",
					type: "post",
					data: {
            
                        ID_ATORES_FILME: $("input[name='ID_ATORES_FILME']").val(),
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_ATOR: $("select[name='ID_ATOR']").val()
                    
					},
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Atores de filme  Alterada com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");

                            $("input[name='ID_ATORES_FILME']").val("");
                            $("select[name='ID_FILME']").val("");
                            $("select[name='ID_ATOR']").val("");
                           paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("Atores de filme Não Alterada! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=atores_filme",
				type: "post",
				data: {
						ID_ATORES_FILME: $("input[name='ID_ATORES_FILME']").val(),
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_ATOR: $("select[name='ID_ATOR']").val()
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Atores de filme inserido com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("Atores de filme Não inserido! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>