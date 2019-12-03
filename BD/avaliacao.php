<?php

include("conexao.php");

$login_cookie = $_COOKIE['login'];

$avaliacao = $_POST["nota"];

$filme = $_POST["filme"];

$sql = "SELECT * 
from usuario
where login = '$login_cookie'";

$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){

        $id_usuario = $linha["ID_USUARIO"];
    }



$sql = "INSERT INTO avaliacao (id_usuario, id_filme, nota) VALUES ($id_usuario ,$filme, $avaliacao)";

$conexao->prepare($sql)->execute([$id_usuario, $filme, $avaliacao]);

echo "Filme avaliado!";


?>