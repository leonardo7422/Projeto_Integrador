
<head>
<link rel="stylesheet" href="bootstrap/3.3.7/css/bootstrap.min.css">
<script src="ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
    .modal-content iframe{
        margin: 0 auto;
        display: block;
    }
</style>
 
</head>
<body>
<div class="bs-example">

    <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">Trailer de <?php echo $titulo?></a>
    
    <?php
    echo"<div id='myModal' class='modal fade'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <iframe width='560' height='315' src='trailer/$titulo.mp4' frameborder='0' allow='block; encrypted-media' allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>";
    ?>
 
</div>     
</body>
<script type="text/javascript">
$(document).ready(function(){

    var url = $("#cartoonVideo").attr('src');

    $("#cartoonVideo").attr('src', '$titulo');

    $("#myModal").on('http://shown.bs.modal', function(){
        $("#cartoonVideo").attr('src', url);
    });
    

    $("#myModal").on('http://hide.bs.modal', function(){
        $("#cartoonVideo").attr('src', '');
    });
});
</script>
</html>    