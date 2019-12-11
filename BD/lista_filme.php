<link rel="stylesheet" type="text/css" href="css/style_filme.css">

<?php

//recebimento do login e verificação
$login_cookie = $_COOKIE['login'];

if(isset($login_cookie)){ 
}
else
{
  header("Location:login.html");
}
//---------------------------

//get recebido do index
$filme = $_GET["var"];

include("conexao.php");

include("cabecalholayout.php");

echo"<div id='site'";


//select pra receber dados do filme comparando o valor recebido pelo get
	$sql = "SELECT *
FROM
    filme
        INNER JOIN
    diretor ON filme.id_diretor = diretor.id_diretor
        INNER JOIN
    atores_filme ON filme.id_filme = atores_filme.id_filme
        INNER JOIN
    ATOR ON atores_filme.id_ator = ator.id_ator
        INNER JOIN
    classificacao ON filme.id_classificacao = classificacao.id_classificacao
        INNER JOIN
    genero_filme ON filme.id_filme = genero_filme.id_filme
        INNER JOIN
    genero ON genero_filme.id_genero = genero.id_genero
        AND titulo LIKE '$filme'
LIMIT 1";
	
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){

		$titulo = $linha["TITULO"];
		$sinopse = $linha["SINOPSE"];			 
		$ficha_tecnica = $linha["FICHA_TECNICA"];
		$data_estreia = $linha["DATA_ESTREIA"];
		$descricao_genero = $linha["DESCRICAO_GENERO"];
		$nome_diretor = $linha["NOME_DIRETOR"];		
		$id_filme = $linha["ID_FILME"];	
		$classificacao = $linha["CLASSIFICACAO_INDICATIVA"];

}
		//exibição dos dados específicos pro usuário do filme selecionado
		echo"<div id='site'";

		echo"<span class='fonte'><span class='vermelho'>".$titulo."</span>";

		echo" <span class='classificacao c-$classificacao'>$classificacao</span><br/><br/><img src='img/$titulo.jpg'   weight=700px  width = 400px />";

		include("trailer.php");

		echo "<h3>Sinope: $sinopse</h3></p><br/>";

		echo"<p><li>$ficha_tecnica</li></p>"; 

		echo"<p><li>Gênero: $descricao_genero</li></p>"; 

		echo"<p><li>Diretor: $nome_diretor</li></p>"; 

		echo"<p><li>Lancamento: $data_estreia</li></p>"; 

		echo" <form action='lista_desejo.php' method='get'>";

		echo"<p><li>Avalie o filme:</p></li>";

		include("avaliacao.html");

		echo"<a href='lista_desejo.php?filme=$titulo'>Adicionar $titulo em Sua Lista de Desejo</a><br/>";

		echo"<a href='filmes_assistidos.php?filme=$titulo'>Já assistiu $titulo?</a><br/>";

		echo "</div>";
		//--------------------------------


		//estrutura html básica com title intulado pelo nome do filme
echo"<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'/>
<title>$titulo</title>";

include("footer.html");

//AJAX para enviar a nota da avaliação feito pelas estrelas e o id do filme avaliado para a avaliacao.php
?>
<script>
 $(document).ready(function(){

<?php echo "var id_filme = $id_filme;"; ?>

$("#s1, #s2, #s3, #s4, #s5").click(function(){
	valor = $(this).attr("value");
   $.ajax({
	url: 'avaliacao.php',
	type: 'POST',
	data: {nota: valor,
		filme: id_filme
	},
	success: function(d){
		avaliar(valor);
		alert(d);
		
	  
	}
   });
});
});



</script>



