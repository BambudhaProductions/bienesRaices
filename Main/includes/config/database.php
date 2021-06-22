<?php

function conectarDB() : mysqli {
    $db = mysqli_connect("localhost","root","root","bienes_raices");
    
    if(!$db){
        echo "Error 404";
        exit; // se detiene la ejecucion para no mostrar informacion sensible    
    }
   
    return $db; // retorna la instancia de la conexion
}