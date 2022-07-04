<?php
    $Router = new \Bramus\Router\Router();
    $Router->set404(function(){
        echo "Page not found - 404";
    });

    include "./routers/middleware.php";
    include "./routers/api.php";

    /**
     * Se escribe la ruta en el primer parametro y en el segundo, el nombre de la clase controlador, separado por un @ y el método que se ejecutará
     * $Router->tipoDePeticiónHttp('ruta', 'controlador@metodo'). Por recomendación, las clases deberian ser estáticas (static class)
     */

    ### Rutas ###
    $Router->get("/", function(){
        echo "Main page";
    });
    

    $Router->run();
?>