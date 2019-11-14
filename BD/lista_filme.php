
<style> 

body{text-align: left; }

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
	
	background: url(cinema.jpg) center center no-repeat fixed;
	
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

 h1{ letter-spacing: 5px;
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



  $login_cookie = $_COOKIE['login'];
    if(isset($login_cookie)){ 


 
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
	  header("Location:login.html");
    }

	include("../classeLayout/classeCabecalhoHTML.php");
	
	include("cabecalho.php");

	echo"</div>";
	
	

	


	
	$sql = "SELECT * 
	FROM filme, genero_filme, genero, diretor, ator
	WHERE filme.id_filme = genero_filme.id_filme
	AND genero_filme.id_genero = genero.id_genero
	AND filme.id_diretor = diretor.id_diretor
	AND filme.id_ator = ator.id_ator
	AND titulo like '$filme%'";
	
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



		
	

		  echo" <span class='classificacao c-$classificacao'>$classificacao</span><br/><br/><img src='js/$titulo.jpg'   weight=700px  width = 400px />";

		
echo"<h3>Avalie o filme:</h3>";




	


		echo"<h3>Trailer:
		<br/>
		<video width=\"700\" height=\"400\"  controls=\"controls\" autoplay=\"autoplay\">
		<source src='$filme.mp4' type=\"video/mp4\"></h3>";
		



			

		  
		  echo "<p><h3>Sinope: $sinopse</h3></p>";
		  

		  echo"<h3>$ficha_tecnica</h3>"; 

		  echo"<p><h3>Gênero: $descricao_genero</h3>"; 

		  echo"<p><h3>Diretor: $nome_diretor</h3>"; 

		  echo"<p><h3>Lancamento: $data_estreia</h3>"; 
		  

	


	
	
	echo "	</div>";
	$filme = null;
?> 