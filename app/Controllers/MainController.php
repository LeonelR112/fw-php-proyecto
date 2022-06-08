<?php
    class MainController{
        static function renderIndex(){
            $Model = new MainModel;
            view("homepage.index", ["titulo" => "Título de la página web"]);
        }
    }
?>