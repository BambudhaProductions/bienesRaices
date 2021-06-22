<?php
    //validar el id
    $id = $_GET["id"];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    //Importar la base de datos
    require "includes/config/database.php";
    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    //Obtener los resultados
    $resultado = mysqli_query($db, $query); // retorna arreglo de resultados

    if(!$resultado->num_rows){ //flecha de objet (0 no existe / 1 existe)
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);


    require "includes/funciones.php";
    includeTemplate("header");
?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad["titulo"]; ?></h1>


            <img loading="lazy" src="/Imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen de la propiedad">  
       

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad["precio"]; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad["wc"]; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad["estacionamiento"]; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad["habitaciones"]; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad["descripcion"]; ?></p>
            <p>Phasellus sollicitudin rhoncus sollicitudin. Mauris eu congue sapien, id rhoncus lacus. Quisque porta ornare tincidunt.
            Sed ornare eu magna eget malesuada. Etiam a massa vitae diam fringilla elementum non vitae quam. Proin sagittis 
            volutpat erat, ut malesuada quam elementum consequat. Nunc id erat ut tortor condimentum facilisis. Sed euismod 
            urna vel accumsan tempor. Nulla ac volutpat dui, eu luctus ligula. Proin vitae varius tellus. Donec eu sapien non 
            nibh vehicula dapibus pulvinar et nulla. Vivamus felis neque, posuere vel velit vitae, porta fermentum sapien.</p>
        </div>
    </main>
    
    <?php 
    //Cerrar la conexion
    mysqli_close($db);

    includeTemplate("footer"); ?>