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

include("conexao.php");

include("cabecalholayout.php");

echo"<div id='site'";

include("../classeLayout/classeCabecalhoHTML.php");


//Verificação de recebimento por get e inserir, caso não haja dados no get, será exibido somente os dados já existentes no banco
if(!empty($_GET['filme'])) 
{

$filme = $_GET['filme'];

//Select para indicar a classificação de cada filme
$sql = "SELECT *
from filme, classificacao
where classificacao.id_classificacao = filme.id_classificacao
and titulo = '$filme'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
        $id_filme = $linha["ID_FILME"];    
    } 		
    //-------------------------

    //Select pra pegar o id do usuario a partir do login cookie
    $sql = "SELECT *
    from usuario
    where login = '$login_cookie'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
     $id_usuario = $linha["ID_USUARIO"];
}
//--------------------------

//Insert com os dados já recebidos anteriormente
$sql = "INSERT INTO historico (id_usuario, id_filme) VALUES ($id_usuario,$id_filme)";

    $conexao->prepare($sql)->execute([$id_filme, $id_usuario]);

    }
    //-------------------------------------------------------------------
    
        //condição pra caso não haja filme nenhum inserido no historico
        $verif = false;

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
     
        $verif = true;
}
    
    //verificação pra informar o usuário que ele não adicionou nenhum filme no historico
    if($verif == false){
        echo"<p>Você Não Assistiu Nenhum Filme...";
        }

     include("footer.html");

     ?>

<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'/>
<title>Filmes Assistidos</title>









