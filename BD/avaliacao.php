<?php

include("conexao.php");

//login recebido por cookie
$login_cookie = $_COOKIE['login'];

//recebimento da avaliação e filme por AJAX
$avaliacao = $_POST["nota"];

$filme = $_POST["filme"];
//-----------

//Select pra pegar id_usuario comparando o login recebido
$sql = "SELECT * 
from usuario
where login = '$login_cookie'";

$stmt = $conexao->prepare($sql);
	
	$stmt->execute();

	while($linha=$stmt->fetch()){

        $id_usuario = $linha["ID_USUARIO"];
    }

        //Select para verificar se existe alguma avaliação do usuario específico
        $sql = "SELECT *
        from avaliacao
        where id_usuario = $id_usuario
        and id_filme = $filme";

    
            $stmt = $conexao->prepare($sql);
                
            $stmt->execute();

            //caso não exista resultados no select feito acima, ele irá inserir uma nova linha
            if($linha=$stmt->fetch() == null){
    
                $sql = "INSERT INTO avaliacao (id_usuario, id_filme, nota) VALUES ($id_usuario ,$filme, $avaliacao)";

                $conexao->prepare($sql)->execute([$id_usuario, $filme, $avaliacao]);

                echo "Filme avaliado!";

            }
            //Senão, ele irá dar um update da nota sob a nota já existente
            else
            {
                $sql = " UPDATE avaliacao  SET nota = $avaliacao WHERE id_usuario = $id_usuario  AND id_filme = $filme;";

                $conexao->prepare($sql)->execute([$id_usuario, $filme, $avaliacao]);

                echo "Avaliação atualizada!";
               
            }


?>