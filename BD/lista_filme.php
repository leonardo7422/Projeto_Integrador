<?php

$login_cookie = $_COOKIE['login'];

if(isset($login_cookie)){ 
}
else
{

  header("Location:login.html");
}
?>
<style> 

.tim {
    border: 0;
    padding: 0;
    display: inline;
    background: none;
    text-decoration: underline;
    color: blue;
}
button:hover {
    cursor: pointer;
}

body{
	text-align: left; 
}

.estrelas input[type=radio] {
  display: none;
}
.estrelas label i.fa{
  font-size: 1.8em;
  margin: 30px
}

.estrelas label i.fa:before {
  content:'\f005';
  color: #FC0;
}

.estrelas input[type=radio]:checked ~ label i.fa:before {
  color: #666;
}

.fonte{
	font-weight: bold;
    font-size: 1.5em;
}

.classificacao {
    height: 12px;
    margin-top: 20px;
    padding: 7px;
    color: #fff;
    border-radius: 8px;
    font-size: .7em;
	float: none;
    vertical-align: middle;
    font-size: 20px;
}

span{ 
	color: black;
}
.classificacao.c-LIVRE {
    background: green;
}

.classificacao.c-10 {
    background: #a6dced;
}

.classificacao.c-14 {
    background: orange;
}
.classificacao.c-16 {
    background: #ff3838;
}

.classificacao.c-18 {
    background: black;
}

#site {
	border-style: ridge;
    padding: 15px;
	margin: 20px auto;
	background: #FFF; /* fundo branco para navegadores que não suportam rgba */
	background: rgba(255,255,255,0.8); /* fundo branco com um pouco de transparência */
}

body {	
	background: url(img/cinema.jpg) center center no-repeat fixed;
	
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}p {
  background-color: lightgrey;
}

h3{
	text-align:left;
	text-indent: 3.0em;
	width: 700px; 
	font-size: 20px;
}

h2{
	font-family: "Gill Sans", sans-serif;
	text-align: left;
}

h1{ 
	 letter-spacing: 5px;
	text-indent: 1.5em;
}
img{
		position: right; 
	left: 300px; /* posiciona a 90px para a esquerda */ 
	top: 70px; /* posiciona a 70px para baixo */
			}

video{
	left: 50px;
	margin: 20px;
		}
	</style>

<?php
session_start();


$filme = $_GET["var"];



$_SESSION["var"] = $filme; 


include("conexao.php");

$sql = "SELECT *
FROM filme";

$stmt = $conexao->prepare($sql);
	
$stmt->execute();

include("cabecalholayout.php");

echo"<div id='site'";

$acesso = $_COOKIE['acesso'];

if($acesso == 'adm'){
	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
	echo"</div>";
	}

	$sql = "SELECT * 
	FROM filme, genero_filme, genero, diretor, atores_filme, ator
	WHERE filme.id_filme = genero_filme.id_filme
	AND genero_filme.id_genero = genero.id_genero
	AND filme.id_diretor = diretor.id_diretor
	AND filme.id_filme = atores_filme.id_filme
    and atores_filme.id_ator = ator.id_ator
	AND titulo like'$filme'
    limit 1";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){

		$titulo = $linha["TITULO"];
		$sinopse = $linha["SINOPSE"];			 
		$ficha_tecnica = $linha["FICHA_TECNICA"];
		$data_estreia = $linha["DATA_ESTREIA"];
		$descricao_genero = $linha["DESCRICAO_GENERO"];
		$nome_diretor = $linha["NOME_DIRETOR"];			
}

	$sql = "SELECT CLASSIFICACAO_INDICATIVA, TITULO
	FROM CLASSIFICACAO, FILME
	WHERE FILME.ID_CLASSIFICACAO = CLASSIFICACAO.ID_CLASSIFICACAO
	AND TITULO = '$titulo'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){


		$classificacao = $linha["CLASSIFICACAO_INDICATIVA"];
		$titulo = $linha["TITULO"];

	}

	echo"<div id='site'";

	echo"<span class='fonte'><span class='vermelho'>".$titulo."</span>";

		  echo" <span class='classificacao c-$classificacao'>$classificacao</span><br/><br/><img src='img/$titulo.jpg'   weight=700px  width = 400px />";
	
echo"<p><li>Avalie o filme:</p></li>";


include("trailer.php");
	  
		  echo "<h3>Sinope: $sinopse</h3></p><br/>";
		  
		  echo"<p><li>$ficha_tecnica</li></p>"; 

		  echo"<p><li>Gênero: $descricao_genero</li></p>"; 

		  echo"<p><li>Diretor: $nome_diretor</li></p>"; 

		  echo"<p><li>Lancamento: $data_estreia</li></p>"; 
		  
		 echo" <form action='lista_desejo.php' method='get'>";
		
		include("avaliacao.html");



		echo"<a href='lista_desejo.php?filme=$titulo'>Adicionar $titulo em Sua Lista de Desejo</a><br/>";

		echo"<a href='filmes_assistidos.php?filme=$titulo'>Já assistiu $titulo?</a><br/><br/>";


?>
<script>

$("Avaliar()").click(function(){
	$.ajax({
			url: "lista_filme.php?var=$titulo",
			type: "post",
			data: {
					id: $("rating").val(),
					
				},
				beforeSend: function(){
					$("button").attr("disabled",true);
				},
				success: function(d){
					console.log(d);
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
<?php
	echo "	</div>";

echo"<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<title> $titulo</title>";

?>