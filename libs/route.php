<?php
    /**
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