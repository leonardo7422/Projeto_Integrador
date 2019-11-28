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



//FILMES PRA LISTAR CASO JÁ TENHA NA LISTA DE DESEJO
$sql = "SELECT *
from lista_desejo, usuario, filme, sessao, cinema, cidade
where usuario.id_usuario = lista_desejo.id_usuario
and lista_desejo.id_filme = filme.id_filme
and filme.id_filme = sessao.id_filme
and sessao.id_cinema = cinema.id_cinema
and cinema.id_cidade = cidade.id_cidade
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

        echo"<p><h2>$titulo</p></h2>";

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
    
     
    
    
        echo"<p>Sessões de $titulo: </p><p>Cinema: $cinema </p><p>Cidade: $cidade</p><p> Horário: $hora</p><p>Site Ingresso: $site</p>";

       echo"Site pra compra: <a href='$site'>$site</a><br/><br/>";

        }
        



    
?>








