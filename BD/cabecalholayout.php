

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=5">
  <link rel="stylesheet" href="bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="bootstrap/3.4.0/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ALFRED</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Filmes<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <?php
        
        while($linha=$stmt->fetch()){
	
			
    $titulo = $linha["TITULO"];
        echo"
        <li><a href='lista_filme.php?var=$titulo'>$titulo</a></li>";
}


   ?>
        </ul>
      </li>
      <li><a href="lista_desejo.php">Lista de Desejos</a></li>
      <li><a href="filmes_assistidos.php">Filmes Já Assistidos</a></li>
      <li><a href="logout.php">Logout</a></li>
   

   
  </script>

    </ul>
  </div>
</nav>
  
<div class="container">
</div>