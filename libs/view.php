<?php
    use eftec\bladeone\BladeOne;

    function view(string $template, array $params = []){
        $blade = new BladeOne(VIEWS, CACHE_VIEWS, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
        echo $blade->run($template, $params);
    }
?>