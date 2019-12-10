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
	$tabelas[0][0]="sessao";
	$tabelas[0][1]=null;
	$ordenacao = null;
	$condicao = $_POST["id"];
	
	$stmt = $c->selecionar($colunas,$tabelas,$ordenacao,$condicao);
	$linha = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$value_id_sessao = $linha["ID_SESSAO"];
    $select_id_filme = $linha["ID_FILME"];
    $select_id_cinema= $linha["ID_CINEMA"];
	$value_horario = $linha["HORARIO"];
    $select_site_compra = $linha["SITE_COMPRA"];
 
	$action = "altera.php?tabela=sessao";
}
else{
    $action = "insere.php?tabela=sessao";
    
	$value_id_sessao="";
    $select_id_filme ="";
    $select_id_cinema="";
    $value_horario ="";
    $value_site_compra ="";
   }

//___________________________________________________________________________________
    
	$select = "SELECT ID_FILME AS value, TITULO AS texto FROM FILME ORDER BY TITULO";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
	
	while($linha=$stmt->fetch()){
		$matriz_filme[] = $linha;
	}	

	$select = "SELECT ID_CINEMA AS value , NOME_CINEMA AS texto FROM CINEMA ORDER BY NOME_CINEMA";
	
	$stmt = $conexao->prepare($select);
	$stmt->execute();
    

	while($linha=$stmt->fetch()){
		$matriz_cinema[] = $linha;
    }	
    
//_________________________________________________________________________________________________________

	$v = array("action"=>$action,"method"=>"post");
	$f = new Form($v);
	
	$v = array("type"=>"number","name"=>"ID_SESSAO","placeholder"=>"ID DA SESSAO...","value"=>$value_id_sessao);
    $f->add_input($v);
    
    $v = array("name"=>"ID_FILME","label"=>" Filme","selected"=>$select_id_filme);
    $f->add_select($v,$matriz_filme);
    
    
    $v = array("name"=>"ID_CINEMA","label"=>"CINEMA","selected"=>$select_id_cinema);
    $f->add_select($v,$matriz_cinema);
    

	$v = array("type"=>"text","name"=>"HORARIO","placeholder"=>"Horario da SESSAO...","value"=>$value_horario);
    $f->add_input($v);
    
    $v = array("type"=>"text","name"=>"SITE_COMPRA","placeholder"=>"site para compra...","value"=>$value_site_compra);
    $f->add_input($v);
    

	$v = array("type"=>"button","class"=>"cadastrar","texto"=>"CADASTRAR");
	$f->add_button($v);	
?>
<h3>Formulário - Inserir SESSAO</h3>
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
				data: {tabela: "sessao"},
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
						tabela: "sessao" 
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
									0:{0:"sessao",1:"filme"},
                                    1:{0:"sessao",1:"cinema"}
								},
						colunas:{0:"id_sessao",1:"id_filme", 2:"id_cinema",3:"horario",4:"site_compra"}, 
						pagina: b
					  },
				success: function(matriz){
					$("tbody").html("");
					for(i=0;i<matriz.length;i++){
						tr = "<tr>";
						tr += "<td>"+matriz[i].id_sessao+"</td>";
                        tr += "<td>"+matriz[i].id_filme+"</td>";
                        tr += "<td>"+matriz[i].id_cinema+"</td>";
                        tr += "<td>"+matriz[i].horario+"</td>";
                        tr += "<td>"+matriz[i].site_compra+"</td>";
						
						tr += "<td><button value='"+matriz[i].id_sessao+"' class='remover'>Remover</button>";
						tr += "<button value='"+matriz[i].id_sessao+"' class='alterar'>Alterar</button></td>";
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
				data: {id: id_alterar, tabela: "sessao"},
				success: function(dados){
					$("input[name='ID_SESSAO']").val(dados.ID_SESSAO);
					$("select[name='ID_FILME']").val(dados.ID_FILME);
					$("select[name='ID_CINEMA']").val(dados.ID_CINEMA);
					$("input[name='HORARIO']").val(dados.HORARIO);
					$("input[name='SITE_COMPRA']").val(dados.SITE_COMPRA);
					
					$(".cadastrar").attr("class","alterando");
					$(".alterando").html("ALTERAR");
				}
			});
		});
			
			$(document).on("click",".alterando",function(){
				
				$.ajax({
					url:"altera.php?tabela=sessao",
					type: "post",
					data: {
            
                        ID_SESSAO: $("input[name='ID_SESSAO']").val(),
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_CINEMA: $("select[name='ID_CINEMA']").val(),
                        HORARIO: $("input[name='HORARIO']").val(),
                        SITE_COMPRA: $("input[name='SITE_COMPRA']").val()
					},
					beforeSend:function(){
						$("button").attr("disabled",true);
					},
					success: function(d){
						$("button").attr("disabled",false);
						if(d=='1'){
							$("#status").html("Sessão Alterada com sucesso!");
							$("#status").css("color","green");
							$(".alterando").attr("class","cadastrar");
							$(".cadastrar").html("CADASTRAR");

                            $("input[name='ID_SESSAO']").val("");
                            $("select[name='ID_FILME']").val("");
                            $("select[name='ID_CINEMA']").val("");
                            $("input[name='HORARIO']").val("");
                            $("input[name='SITE_COMPRA']").val("");
                           paginacao(pagina_atual);
						}
						else{
							console.log(d);
							$("#status").html("Sessão Não Alterada! Código já existe!");
							$("#status").css("color","red");
						}
					}
				});
			});
			
			//defina a seguinte regra para o botao de envio
			$(document).on("click",".cadastrar",function(){
			
			$.ajax({
				url: "insere.php?tabela=sessao",
				type: "post",
				data: {
					
						ID_SESSAO: $("input[name='ID_SESSAO']").val(),
                        ID_FILME: $("select[name='ID_FILME']").val(),
                        ID_CINEMA: $("select[name='ID_CINEMA']").val(),
                        HORARIO: $("input[name='HORARIO']").val(),
                        SITE_COMPRA: $("input[name='SITE_COMPRA']").val()
                    
					 },
				beforeSend:function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
                    $("button").attr("disabled",false);
                   
					if(d=='1'){
						$("#status").html("sessao inserida com sucesso!");
						$("#status").css("color","green");
						carrega_botoes();
						paginacao(pagina_atual);
					}
					else{						
						$("#status").html("sessao Não inserida! Código já existe!");
						$("#status").css("color","red");
					}
				}
			});
		});
		
	});
</script>
</body>
</html>