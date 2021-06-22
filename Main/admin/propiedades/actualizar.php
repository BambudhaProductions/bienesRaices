<?php
   require "../../includes/funciones.php";
   $auth = estaAutenticado();

    if(!$auth){
        header("Location: /");
    }   
    
    //Validar la URL por id válido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    // var_dump($_GET["id"]);

    //Importar la conexion de Base de Datos
    require "../../includes/config/database.php";
    $db = conectarDB();

    //Consulta para obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);
   

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //Creamos arreglo con mensajes de errores
    $errores = [];

        $titulo = $propiedad["titulo"];
        $precio = $propiedad["precio"];
        $descripcion = $propiedad["descripcion"];
        $habitaciones = $propiedad["habitaciones"];
        $wc = $propiedad["wc"];
        $estacionamiento = $propiedad["estacionamiento"];
        $vendedorId = $propiedad["vendedorId"];
        $imagenPropiedad = $propiedad["imagen"];

    //Ejecutar el código despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        
        //   echo "<pre>";
        //   var_dump($_POST);
        //   echo "</pre>";

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

        if( strlen($descripcion) < 50 || strlen($descripcion) > 96){ 
            $errores[] = "La Descripcion es Obligatoria y debe tener al menos 50 caracteres y no superar los 96"; 
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

        //Validar por tamaño (1MB maximo)
        $medida = 1000 * 1000; //convertir de bytes a mb
        if($imagen["size"] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
        
        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){
        
         //Crear Carpeta
        $carpetaImagenes = "../../Imagenes/";

        if(!is_dir($carpetaImagenes)) {  // si una carpeta existe o no existe
            mkdir($carpetaImagenes);
        }
          
        $nombreImagen = ''; // generamos la imagen con un string vacio, para que no se borre si no ponen una nueva foto (else)  
         
         /** Subida de Archivos **/ 
        if($imagen['name']){
        //Eliminar la imagen previa (se utiliza unlink para borrar archivos)

            unlink($carpetaImagenes . $propiedad['imagen']);

            //Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(),true) ) . ".jpg";
            //Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes .  $nombreImagen );
        } 
        else {
            $nombreImagen = $propiedad['imagen'];
        }

        //Actualizamos la base de datos (UPDATE/SET/WHERE)

        $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, 
        wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}";
        
        // echo $query; siempre combrobar tus querys antes de ejecutar tus codigos en el table plus (poner el exit siempre que probemos)

            $resultado = mysqli_query($db, $query); // le pasamos la conexion a la base de datos ($db)

            if($resultado){
                //Redireccionar al usuario para evitar que mande formularios duplicados
                header("Location: /admin?resultado=2"); //el header funciona si no hay nada de html previo   
            }
        } 

    }
    
    includeTemplate("header");
    ?>
    
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error; ?>  
            </div>
          
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data"> 
            
            <fieldset>
                <legend>Información General</legend>
                     <label for="titulo">Titulo:</label>
                     <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>"> 
                    
                     <label for="precio">Precio:</label>
                     <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>"> >

                     <label for="imagen">Imagen:</label>
                     <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen"> 
                     <img src="/Imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

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

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>
 
    <?php 
    includeTemplate("footer"); 
    ?>