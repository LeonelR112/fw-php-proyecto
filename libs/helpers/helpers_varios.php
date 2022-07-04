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

    function assetsLink(string $dir_file, $cache = true){
        echo MAIN_URL . "resources/assets/" . $dir_file . ($cache ? "" : "?v" . md5(time()));
    }

    // fin archivos del resource

    //API archivos
    function obtenerHandlerApi(string $nombre_handlerApi){
        try{
            include __DIR__ . "/../../api/" . $nombre_handlerApi . ".php";
        }
        catch(Exception $e){
            printMensajeAlertaCritica($e->getMessage());
            die;
        }
    }

    function responseAPI($respuesta, int $status_code){
        $response = json_encode($respuesta);
        http_response_code($status_code);
        print $response;
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

    //fin logs

    //mensajes de alerta
    function printMensajeAlertaCritica(string $mensaje){
        echo "
            <div style='padding: 1.2em;margin:15px;border: 1px solid red;color: rgb(153, 8, 8);background-color: rgb(255, 182, 182);'>
                <h3>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-octagon-fill' viewBox='0 0 16 16'>
                        <path d='M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                    </svg> 
                    Error crítico!
                </h3>
                <p>
                    ". $mensaje ."
                </p>
            </div>
        ";
    }
?>