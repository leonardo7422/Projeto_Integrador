<?php

include("conexao.php");

$sql = "SELECT *
FROM filme";

$stmt = $conexao->prepare($sql);
	
	$stmt->execute();



include("cabecalholayout.php");

?>

<div id="site">
    
<?php

  $login_cookie = $_COOKIE['login'];

  $sql = "SELECT NOME FROM USUARIO WHERE login = '$login_cookie'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){		

		$nome = $linha["NOME"];
	}


    if(isset($login_cookie)){
      echo"Bem-Vindo, $nome <br>";
      echo"<p>Essas informações <font color='red'>PODEM</font> ser acessadas por você</p>";
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"<p>Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você</p>";
      header("Location:login.html");
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>ALFRED</title>
<style>
* {
	margin: 0;
	padding:0;
}
h1{
	text-align: center;
}
body, html {
	width: 100%;
	height: 100%;
	font-family: Arial, Tahoma, sans-serif;
}
body {
	background: url(cinema.jpg) center center no-repeat fixed;
	
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
#site {
	width: 560px;
	padding: 20px;
	margin: 40px auto;
	background: #FFF; 
	background: rgba(255,255,255,0.8);
p {
	margin-bottom: 1.5em;
}</style>
<script src="js/jquery-ui.min.js"></script>
<script>
</script>
</head>
<body>
	
<meta charset="UTF-8">
<title>ALFRED</title>
<?php
include("../classeLayout/classeCabecalhoHTML.php");
include("cabecalho.php");
?>
<br/>

<link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css"/>
<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/carousel.1.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.carousel').Carousel();
	});
</script>
</head>
<body>


<h1><b> Filmes em Cartaz:</b><h1>
<br/>

<form action="lista_filme.php" method="post">

	<div class='carousel' data-height='80%' data-width='500px' data-effect='size' data-stop_on_hover='true'>
	<a href="lista_filme.php?var=coringa" style="border-bottom: none;"><img src='js/coringa.jpg' alt="Coringa"/></a>
	<a href="lista_filme.php?var=resident " style="border-bottom: none;"><img src='js/resident evil.jpg' alt="Resident Evil"/></a>
	<a href="lista_filme.php?var=django" style="border-bottom: none;"><img src='js/django livre.jpg' alt="Django Livre"/></a>
	
	
	
</div>       
</div>
</body>
</html>