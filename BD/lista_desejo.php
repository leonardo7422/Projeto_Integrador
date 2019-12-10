<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'/>
<title>Filmes Desejados</title>

<link rel="stylesheet" type="text/css" href="css/style_filme.css">

<?php

$login_cookie = $_COOKIE['login'];


if(isset($login_cookie)){
    
}else{

  header("Location:login.html");
}

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


if(!empty($_GET['filme'])) 
{
 
$filme = $_GET['filme'];

$sql = "SELECT *
from filme
where titulo = '$filme'";
	
	$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){
                        
        $id_filme = $linha["ID_FILME"];
    } 		

$sql = "INSERT INTO lista_desejo (id_usuario, id_filme) VALUES ($id_usuario,$id_filme)";

$conexao->prepare($sql)->execute([$id_usuario, $id_filme]);
        }


        $count = false;

//FILMES PRA LISTAR CASO JÁ TENHA NA LISTA DE DESEJO
$sql = "SELECT *
from lista_desejo, usuario, filme, sessao, cinema, cidade, classificacao
where usuario.id_usuario = lista_desejo.id_usuario
and lista_desejo.id_filme = filme.id_filme
and filme.id_filme = sessao.id_filme
and sessao.id_cinema = cinema.id_cinema
and cinema.id_cidade = cidade.id_cidade
and classificacao.id_classificacao = filme.id_classificacao
and usuario.id_usuario = $id_usuario";
    
	$stmt = $conexao->prepare($sql);
	
    $stmt->execute();
    
    while($linha=$stmt->fetch()){
        
        $id_filme = $linha["ID_FILME"];
        $titulo = $linha["TITULO"];
        $cidade = $linha["NOME_CIDADE"];
        $cinema = $linha["NOME_CINEMA"];
        $site = $linha["SITE_COMPRA"];
        $hora = $linha["HORARIO"];
        $classificacao = $linha["CLASSIFICACAO_INDICATIVA"];
        $id_sessao = $linha["ID_SESSAO"];

        echo"<p><h2>$titulo";
       
        echo" <span class='classificacao c-$classificacao'>$classificacao</span></p></h2>";
       
        echo"<p>Sessão $id_sessao de $titulo: </p><p>Cinema: $cinema </p><p>Cidade: $cidade</p><p> Horário: $hora</p>";
        
        echo"Site pra compra do ingresso: <a href='$site'>$site</a><br/><br/>";
        
        $count = true;
        }

            if($count == false){
                echo"<p>Não Existe Filme na Sua Lista de Desejo...";
            }
            
            include("footer.html");
            
        ?>









