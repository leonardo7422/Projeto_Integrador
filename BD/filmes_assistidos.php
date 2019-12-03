<link rel="stylesheet" type="text/css" href="css/style_filme.css">

<?php

$login_cookie = $_COOKIE['login'];

if(isset($login_cookie)){
    
}else{

  header("Location:login.html");
}

include("conexao.php");

$sql = "SELECT *
FROM filme";

$stmt = $conexao->prepare($sql);
	
$stmt->execute();

include("cabecalholayout.php");

echo"<div id='site'";

include("../classeLayout/classeCabecalhoHTML.php");


if(!empty($_GET['filme'])) 
{
$_SESSION['filme']= $_GET['filme'];

$filme = $_SESSION["filme"];

$sql = "SELECT *
from filme, classificacao
where classificacao.id_classificacao = filme.id_classificacao
and titulo = '$filme'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
        $id_filme = $linha["ID_FILME"];    
    } 		

    $sql = "SELECT *
    from usuario
    where login = '$login_cookie'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
     $id_usuario = $linha["ID_USUARIO"];
}

$sql = "INSERT INTO historico (id_usuario, id_filme) VALUES ($id_usuario,$id_filme)";

    $conexao->prepare($sql)->execute([$id_filme, $id_usuario]);

    }

        $count = false;

//FILMES PRA LISTAR CASO JÁ TENHA NA LISTA DE DESEJO
$sql = "SELECT *
from historico, usuario, filme, classificacao
where usuario.id_usuario = historico.id_usuario
and historico.id_filme = filme.id_filme
and classificacao.id_classificacao = filme.id_classificacao
and login = '$login_cookie'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

    while($linha=$stmt->fetch()){
                        
        $id_filme = $linha["ID_FILME"];
        $titulo = $linha["TITULO"];
        $classificacao = $linha["CLASSIFICACAO_INDICATIVA"];


        echo"<p><h2>$titulo";
        echo" <span class='classificacao c-$classificacao'>$classificacao</span></p></h2>";
     
        $count = true;
}
    
    if($count == false){
        echo"<p>Você Não Assistiu Nenhum Filme...";
        }
?>
</div>
<footer>
	&reg; 2019, ALFRED<br/>
		O cinema não é senão o aspecto mais evolutivo do realismo plástico que começa com o Renascimento. (André Malraux)
	</footer>









