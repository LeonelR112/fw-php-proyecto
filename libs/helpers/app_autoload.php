<?php
    define("DS", DIRECTORY_SEPARATOR);

    function app_autoload(string $classname){
        $lower_classname = strtolower($classname);
        if(preg_match("/controller/", $lower_classname)){
            require_once "./app/Controllers/" . $classname . ".php";
        }
        else if(preg_match("/model/", $lower_classname)){
            require_once "./app/Models/" . $classname . ".php";
        }
    }

    spl_autoload_register('app_autoload');
?>