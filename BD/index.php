<?php

include("conexao.php");


$login_cookie = $_COOKIE['login'];


$sql = "SELECT * FROM USUARIO WHERE login = '$login_cookie'";
	
$stmt = $conexao->prepare($sql);

$stmt->execute();

while($linha=$stmt->fetch()){		

	$nome = $linha["NOME"];
	$acesso = $linha["ACESSO"];

	setcookie("acesso",$acesso);
}

if(isset($login_cookie)){

  }else{
	echo"Bem-Vindo, $nome <br>";
	echo"<p>Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você</p>";
	header("Location:login.html");
  }

$sql = "SELECT *
FROM filme";

$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

include("cabecalholayout.php");

	echo"<div id='site'>";

	echo"<b>Bem-Vindo, $nome </b><br>";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>ALFRED</title>
		<script src="js/jquery-ui.min.js"></script>
	</head>
<body>
	
<meta charset="UTF-8">
<title>ALFRED</title>
<?php

if($acesso == 'adm'){

	include("../classeLayout/classeCabecalhoHTML.php");
	include("cabecalho.php");
}
?>
<br/>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css"/>
		<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/carousel.1.0.js"></script>
		<script type="text/javascript">

	$(document).ready(function(){
		$('.carousel').Carousel();
	});

</script>

<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body>
		<h1><b> Filmes em Cartaz:</b><h1>
			<br/>

		<form action="lista_filme.php" method="post">

			<div class='carousel' data-height='80%' data-width='500px' data-effect='size' data-stop_on_hover='true'>

<?php 

$sql = "SELECT  *
FROM FILME";

$stmt = $conexao->prepare($sql);

$stmt->execute();

while($linha=$stmt->fetch()){


	$titulo = $linha["TITULO"];

	echo"<a href='lista_filme.php?var=$titulo' style='border-bottom: none;'><img src='img/$titulo.jpg' alt='Coringa'/></a>";

}

?>
</body>
</html>