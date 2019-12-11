<link rel="stylesheet" type="text/css" href="css/style_filme.css">

<?php

//Verificar se o usuário está logado
$login_cookie = $_COOKIE['login'];

if(isset($login_cookie)){    
}
else
{
  header("Location:login.html");
}
//-----------------------

include("conexao.php");

//Pegar usuário comparando o login
$sql = "SELECT *
from usuario
where login = '$login_cookie'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
        $id_usuario = $linha["ID_USUARIO"];
}


include("cabecalholayout.php");

echo"<div id='site'";

include("../classeLayout/classeCabecalhoHTML.php");

//condição para caso o usuario não tenha avaliado ainda
$verif = false;

//Select para receber todas as avaliações do respectivo usuário
$sql = "SELECT *
from avaliacao, filme, classificacao
where filme.id_filme = avaliacao.id_filme
and classificacao.id_classificacao = filme.id_classificacao
and id_usuario = $id_usuario";

$stmt = $conexao->prepare($sql);
	
    $stmt->execute();
    
    while($linha=$stmt->fetch()){
        
        $titulo = $linha["TITULO"];
        $nota = $linha["NOTA"];
        $classificacao = $linha["CLASSIFICACAO_INDICATIVA"];
    

    echo"<p><h2>$titulo";
       
    echo" <span class='classificacao c-$classificacao'>$classificacao</span></p></h2>";

    echo"<p>Número de estrelas dadas pro filme: $nota</p>";

    $verif = true;
    }

    //---------------------------------------

//Verificação para informar o usuario que ele não avaliou ainda
    if($verif == false){
      echo"<p>Você Não Avaliou Nenhum Filme...";
      }

     include("footer.html");

     ?>

<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'/>
<title>Avaliações</title>