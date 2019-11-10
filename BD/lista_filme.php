
<style> 


   .titulo {
    font-family: "Akkurat Light Pro";
	text-indent: 1.5em;
    
    font-size: 35px;
    float: left;
    border-bottom: 3px solid #363636;
    padding-bottom: 5px;
}



.classificacao {
	
    height: 12px;
    margin-top: 20px;
    padding: 10px 7px;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    font-size: .7em;
	float: none;
    vertical-align: middle;
    font-size: 20px;
}
span{ 
	color: white;
	
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
    padding: 5px;
	
	margin: 40px auto;
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
	align:left;
  border-bottom: 3px solid black;
  width: 0%;
  background-color: lightgrey;

}

h3{
	text-align:left;
	text-indent: 3.0em;

}

h2{
	font-family: "Gill Sans", sans-serif;
	width: 1500px;
	text-indent: 3.0em;
	


}

 h1{ letter-spacing: 5px;
	text-indent: 1.5em;
	font-family: "Akkurat Light Pro";


}
	img{
		border: 5px solid red;
	margin: 10px;

			}

		video{
	left: 50px;
	margin: 20px;


		}
	</style>

<?php
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
	
	include("conexao.php");
	

	$filme = $_GET["var"];


	
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
	WHERE FILME.ID_FILME = CLASSIFICACAO.ID_FILME
	AND TITULO LIKE '$filme%'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){


		$classificacao = $linha["CLASSIFICACAO_INDICATIVA"];
		$titulo = $linha["TITULO"];

	}


	
	

	echo"<div id='site'";


	echo"<br/>";

		echo" <img src='JS/$filme.jpg'  align = 'left' weight=500px width = 500px />";



		
	

		echo"<h2>$titulo <span class='classificacao c-$classificacao'>$classificacao</span></h2>";

		echo"<br/><h2>Trailer:
		<br/>
		<video width=\"700\" height=\"400\"  controls=\"controls\" autoplay=\"autoplay\">
		<source src='$filme.mp4' type=\"video/mp4\"></h3>";
		



			

		  
		  echo "<p><h2>Sinope:</h2>"; echo"<h2>$sinopse"; echo"</p>";
		  

		  echo"<h2>$ficha_tecnica</h2>"; 

		  echo"<p><h2>Sinope: $descricao_genero</h2>"; 

		  echo"<p><h2>Diretor: $nome_diretor</h2>"; 

		  echo"<p><h2>Lancamento: $data_estreia</h2>"; 
		  

	


	
	
	echo "</tbody>
		</table>
		</div>";
	$filme = null;
?> 