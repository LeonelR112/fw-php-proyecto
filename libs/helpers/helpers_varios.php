<?php

    //atajo a carpetas
    function resources(string $ruta){
        return MAIN_URL . "resources/" . $ruta;
    } 

    function assets(string $ruta){
        return MAIN_URL . "resources/assets/" . $ruta;
    } 

    function css(string $ruta){
        return MAIN_URL . "resources/css/" . $ruta;
    } 

    function js(string $ruta){
        return MAIN_URL . "resources/js/" . $ruta;
    }
    // fin atajos a carpetas

    //obtener un archivo del resource
    function cssFile(string $dirname, bool $cache = true){
        print '<link rel="stylesheet" href="'. MAIN_URL .'resources/css/'. $dirname .'.css'. ($cache ? "" : "?v" . md5(time())) .'">';
    }

    function jsFile(string $dirname, bool $cache = true){
        print '<script src="'. MAIN_URL .'resources/js/'. $dirname .'.js'. ($cache ? "" : "?v" . md5(time())) .'"></script';
    }
    //fin obtener un archivo del resource

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

    /** Router
     * devuelve un link de acceso directo, se pueden agregar en el segundo parametro un array asociativo "clave => valor" para peticiones POST (opcional). Mientras
     * en el tercer parametro un array asociativo para imprimir parámetros get en la url "clave => "valor", si el parametro url es un string vacío, devuelve el
     * link con la url base.
     */

     function route(string $url, array $post_params = [], array $get_params = []){
        $url = htmlspecialchars(addslashes($url));
        $url_destiny = MAIN_URL;
        $url_destiny .= $url;
        if($url == ""){
            return $url_destiny;
        }
        else{
            if(substr($url, -1) != "/"){ 
                //la url pasada no tiene en el final un slash, se le adiciona directamente en la funión del route
                $url_destiny .= "/";
            }
    
            if(count($post_params) > 0){
                foreach ($post_params AS $key => $valor) {
                    $url_destiny .= $key . "/" . $valor . "/";
                }
            }
    
            if(count($get_params) > 0){
                $url_destiny .= "?";
                $total_parametros = count($get_params);
                $agregados = 0;
                foreach ($get_params as $key => $valor) {
                    $valor = preg_replace("/\s/", "%20", $valor);
                    $url_destiny .= $key . "=" . $valor;
                    $agregados ++;
                    if($agregados < $total_parametros){
                        $url_destiny .= "&";
                    }
                }
            }
    
            return $url_destiny;
        }
    }

    function redirectTo(string $url = ""){
        header("location: " . MAIN_URL . $url);
        exit;
    }
?>