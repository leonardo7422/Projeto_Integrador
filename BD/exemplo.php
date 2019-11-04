<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <title>Carousel</title>
        <link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/carousel.1.0.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.carousel').Carousel();
            });
        </script>
    </head>
    <body>
            <div class='carousel' data-height='100%' data-width='600px' data-effect='size' data-stop_on_hover='true'>
            <img src="JS/coringa.jpg" />
            <img src="JS/halloween.jpg" />
            <img src="JS/resident.jpg" />
            <img src="JS/theprofessional.jpg" />
            
    </div>       
    </body>
</html>