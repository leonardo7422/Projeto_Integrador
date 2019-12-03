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
from filme
where titulo = '$filme'";
	
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
and login = '$login_cookie'";
    
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
       
        echo"<p>Sessões $id_sessao de $titulo: </p><p>Cinema: $cinema </p><p>Cidade: $cidade</p><p> Horário: $hora</p><p>Site Ingresso: $site</p>";
        
        echo"Site pra compra: <a href='$site'>$site</a><br/><br/>";
        
        $count = true;
        }

            if($count == false){
                echo"<p>Não Existe Filme na Sua Lista de Desejo";
            }
            
?>
</div>
<footer>
	&reg; 2019, ALFRED<br/>
		O cinema não é senão o aspecto mais evolutivo do realismo plástico que começa com o Renascimento. (André Malraux)
	</footer>








