<?php
    require "includes/funciones.php";
    includeTemplate("header");
    ?>

    <main class="contenedor seccion">
        <section class="seccion contenedor">
            <h2>Casas y Depas en Venta</h2>
    
        <?php 
            $limite = 9;
            include "includes/templates/anuncios.php";  
        ?>
        
    </main>

    <?php includeTemplate("footer"); ?>