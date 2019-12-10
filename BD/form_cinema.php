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
	$tabelas[0][0]="cinema";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $value_id_cinema = $linha["ID_CINEMA"];
    $value_nome_cinema = $linha["NOME_CINEMA"];
    $select_id_cidade = $linha["ID_CIDADE"];
   
	$action = "altera.php?tabela=cinema";
}
else{
    $action = "insere.php?tabela=cinema";
    
    $value_id_cinema ="";
    $value_nome_cinema="";
    $select_id_cidade ="";

}

//___________________________________________________________________________________
    
	$select = "SELECT ID_CIDADE AS value, NOME_CIDADE AS texto FROM CIDADE ORDER BY NOME_CIDADE";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz[] = $linha;
    }	
    
//_________________________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_CINEMA","placeholder"=>"ID DO  CINEMA...","value"=>$value_id_cinema);
    $f->add_input($v);

    
	$v = array("type"=>"text","name"=>"NOME_CINEMA","placeholder"=>"NOME DO CINEMA...","value"=>$value_nome_cinema);
    $f->add_input($v);
    
    $v = array("name"=>"ID_CIDADE","label"=>"Cidade","selected"=>$select_id_cidade);
    $f->add_select($v,$matriz);
    
	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir Cidade</h3>
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
				data: {tabela: "cinema"},
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
						tabela: "cinema" 
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
									0:{0:"cinema",1:"cidade"},
								},
						colunas:{0:"id_cinema",1:"nome_cinema", 2:"id_cidade"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
						tr += "<td>"+matriz[i].id_cinema+"</td>";
                        tr += "<td>"+matriz[i].nome_cinema+"</td>";
                        tr += "<td>"+matriz[i].id_cidade+"</td>";
                
						tr += "<td><button value='"+matriz[i].id_cinema+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_cinema+"' class='alterar'>Alterar</button></td>";
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
				data: {id: id_alterar, tabela: "cinema"},
				success: function(dados){
					$("input[name='ID_CINEMA']").val(dados.ID_CINEMA);
                    $("input[name='NOME_CINEMA']").val(dados.NOME_CINEMA);
					$("select[name='ID_CIDADE']").val(dados.ID_CIDADE);
					
                    $(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=cinema",
					type: "post",
					data: {
            
                        ID_CINEMA: $("input[name='ID_CINEMA']").val(),
                        NOME_CINEMA: $("input[name='NOME_CINEMA']").val(),
                        ID_CIDADE: $("select[name='ID_CIDADE']").val()

					},
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Cinema Alterado com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");

                                
                            $("input[name='ID_CINEMA']").val("");
                            $("input[name='NOME_CINEMA']").val("");
                            $("select[name='ID_CIDADE']").val("");

							paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("Cinema Não Alterado! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=cinema",
				type: "post",
				data: {
                        
                        
                        ID_CINEMA: $("input[name='ID_CINEMA']").val(),
                        NOME_CINEMA: $("input[name='NOME_CINEMA']").val(),
                        ID_CIDADE: $("select[name='ID_CIDADE']").val()



					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("Cinema inserido com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("Cinema Não inserida! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>