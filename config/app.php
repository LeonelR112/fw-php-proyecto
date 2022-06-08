<?php
    date_default_timezone_set($_ENV['REGION_HORARIA']);
    const VIEWS = __DIR__ . '/../app/' .'views/';
    const CACHE_VIEWS = __DIR__ . "/../cache/bladeone";
    const PROVINCIAS_DEFAULT = ["Buenos Aires", "Bs.As. CABA", "Bs.As. Conurbano", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes", "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuquen", "Rio Negro", "Salta", "San Juan", "San Luis", "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", "Tucumán"];
    const TITLE_PAGE = "My App";
    const MAIN_URL = "http://localhost/FW-PHPv1/";
?>