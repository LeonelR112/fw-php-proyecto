<?php

    // Obtener archivos del resource
    /**
     * Estos helpers traen o imprimen el link directo al archivo dentro de la carpeta resources, tiene un parámetro para indicar el archivo o ruta del archivo
     * y el segundo parámetro especificar si al obtener el archivo/url poner un parámetro aleatorio para no usar el cache del navegador y ver los cambios en
     * el momento.
     */

    function printCssFileDir(string $dir_file, bool $cache = true){
        echo MAIN_URL . "resources/css/" . $dir_file . ($cache ? "" : "?v" . md5(time()));
    }

    function getFileCSS(string $dir_file, bool $cache = true){
        if($cache){
            echo '<link rel="stylesheet" href="' . MAIN_URL . 'resources/css/'. $dir_file .'">';
        }
        else{
            echo '<link rel="stylesheet" href="' . MAIN_URL . 'resources/css/'. $dir_file .'?v'. md5(time()) .'">';
        }
    }

    function printJSfileDir(string $dir_file, bool $cache = true){
        echo MAIN_URL . "resources/js/" . $dir_file . ($cache ? "" : "?v" . md5(time()));
    }

    function getFileJS(string $dir_file, bool $cache = true){
        if($cache){
            echo '<script src="' . MAIN_URL . 'resources/js/'. $dir_file .'"></script>';
        }
        else{
            echo '<script src="' . MAIN_URL . 'resources/js/'. $dir_file .'?v'. md5(time()) .'"></script>';
        }
    }
    
    //logs
    function logMsgSystem(string $mensaje){
        $fp = fopen(__DIR__ . "/../../logs/log_system.txt", "a+");
        $DateTime = new DateTime('now');
        $format = $DateTime->format("[d-m-Y H:i:s]");
        fwrite($fp, $format . $mensaje . "\n");
        fclose($fp);
    }

    function logMsgError(string $mensaje){
        $fp = fopen(__DIR__ . "/../../logs/log_errors.txt", "a+");
        $DateTime = new DateTime('now');
        $format = $DateTime->format("[d-m-Y H:i:s]");
        fwrite($fp, $format . $mensaje . "\n");
        fclose($fp);
    }

?>