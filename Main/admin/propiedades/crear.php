<?php
    require "../../includes/funciones.php";
    $auth = estaAutenticado();
    
    if(!$auth){
        header("Location: /");
    }
    

    //Importar la conexion de Base de Datos
    require "../../includes/config/database.php";
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //Creamos arreglo con mensajes de errores
    $errores = [];

        $titulo = "";
        $precio = "";
        $descripcion = "";
        $habitaciones = "";
        $wc = "";
        $estacionamiento = "";
        $vendedorId = "";

    //Ejecutar el código despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        
        //  echo "<pre>";
        //  var_dump($_POST);
        //  echo "</pre>";

        //   echo "<pre>";
        //   var_dump($_FILES);
        //   echo "</pre>";

         
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"] );
        $precio =mysqli_real_escape_string($db, $_POST["precio"] );
        $descripcion =mysqli_real_escape_string($db, $_POST["descripcion"] );
        $habitaciones =mysqli_real_escape_string($db, $_POST["habitaciones"] );
        $wc =mysqli_real_escape_string($db, $_POST["wc"] );
        $estacionamiento =mysqli_real_escape_string($db, $_POST["estacionamiento"] );
        $vendedorId =mysqli_real_escape_string($db, $_POST["vendedor"] );
        $creado = date("Y/m/d");

        //Asignar files hacia una variable
        $imagen = $_FILES["imagen"];


        if(!$titulo) { // si no hay titulo o esta vacio
            $errores[] = "Debes añadir un titulo"; // una forma de llenar arreglos en php (no javascript)
        }

        if(!$precio) { 
            $errores[] = "El Precio es Obligatorio"; 
        }

        if( strlen($descripcion) < 50){ 
            $errores[] = "La Descripcion es Obligatoria y debe tener al menos 50 caracteres"; 
        }

        if(!$habitaciones) { 
            $errores[] = "El Numero de Habitaciones es Obligatorio"; 
        }

        if(!$wc) { 
            $errores[] = "El Numero de Baños es Obligatorio"; 
        }
        
        if(!$estacionamiento) { 
            $errores[] = "El Numero de lugares de Estacionamientos es Obligatorio"; 
        }

        if(!$vendedorId) { 
            $errores[] = "Elige un vendedor"; 
        }

        if(!$imagen["name"] || $imagen["error"] ) {
            $errores[] = "La imagen es obligatoria";
        }

        //Validar por tamaño (1MB maximo)
        $medida = 1000 * 1000; //convertir de bytes a mb

        if($imagen["size"] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        
        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){
        
         /** Subida de Archivos **/   

        //Crear Carpeta
        $carpetaImagenes = "../../Imagenes/";

        if(!is_dir($carpetaImagenes)){  // si una carpeta existe o no existe
           
            mkdir($carpetaImagenes);
        }
        //Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(),true) ) . ".jpg";


        //Subir la imagen(los movemos a alguna ubicacion)
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen );

        //Insertar en la base de datos (utilizamos codigo sql dentro de php)
        $query = " INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento, creado,
        vendedorId) VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId')";
        
        //echo $query; para ver el codigo y poder pasarlo al table 

            $resultado = mysqli_query($db, $query); // le pasamos la conexion a la base de datos ($db)

            if($resultado){
                //Redireccionar al usuario para evitar que mande formularios duplicados
                header("Location: /admin?resultado=1"); //el header funciona si no hay nada de html previo   
            }
        }

    }
    
    includeTemplate("header");
    ?>
    
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error; ?>  
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            
            <fieldset>
                <legend>Información General</legend>
                     <label for="titulo">Titulo:</label>
                     <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>"> 
                    
                     <label for="precio">Precio:</label>
                     <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>"> >

                     <label for="imagen">Imagen:</label>
                     <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen"> 

                     <label for="descripcion">Descripcion</label>
                     <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>
                    <label for="habitaciones">Habitaciones:</label>
                    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:3" min="1" max="9" value="<?php echo $habitaciones; ?>">> 

                    <label for="wc">Baños:</label>
                    <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo $wc; ?>">>

                    <label for="estacionamiento">Estacionamiento:</label>
                    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="9" value="<?php echo $estacionamiento; ?>">>  
            
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                    <select name="vendedor">
                        <option value="">-- Seleccione --</option>                  
                        <?php while($row = mysqli_fetch_assoc($resultado) ) : ?>
                           
                            <option <?php echo $vendedorId === $row["id"] ? "selected" : " "; ?> value="<?php echo $row["id"]; ?>"> <?php echo $row["nombre"]." ".$row["apellido"]; ?></option>

                        <?php endwhile; ?> 
                    </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>
 
    <?php 
    includeTemplate("footer"); 
    ?>