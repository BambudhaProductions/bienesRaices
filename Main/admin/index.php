<?php
   require "../includes/funciones.php";
   $auth = estaAutenticado();

    if(!$auth){
        header("Location: /");
    }   
    
    //1.Importar la conexion (5 pasos)
    require "../includes/config/database.php";
    $db = conectarDB();

    //2.Escribir el Query
    $query = "SELECT * FROM propiedades";

    //3.Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);
    
    //Muestra mensaje condicional
    $resultado = $_GET["resultado"] ?? null; // es un placeholder, si no existe que le asigne null

    //revisamos el request method para que no cree un undefined en nuestras variables
    if($_SERVER["REQUEST_METHOD"] === "POST" ){
        
        $id = $_POST['id']; // este $_POST no va a existir hasta que no se mande este request method
        $id = filter_var($id , FILTER_VALIDATE_INT);

        if($id) {

             //Eliminar el archivo
             $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
             $resultado = mysqli_query($db, $query);
             $propiedad = mysqli_fetch_assoc($resultado);

             unlink("../imagenes/" . $propiedad['imagen']);
            
            //Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}"; 
            $resultado = mysqli_query($db, $query);

            var_dump($query);

            if($resultado){
                header("Location: /admin?resultado=3"); 
            }
        }
    }

    //Incluye un template
    includeTemplate("header");
    ?>
    
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($resultado) === 1): ?> 
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif(intval($resultado) === 2) :?>
            <p class="alerta exito">Anuncio actualizado correctamente</p> 
         <?php elseif(intval($resultado) === 3) :?>
            <p class="alerta exito">Anuncio Eliminado correctamente</p>    
        <?php endif; ?>

       

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- 4.Mostrar los resultados -->
                <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad["id"];?></td> <!-- table data -->
                    <td><?php echo $propiedad["titulo"];?></td>
                    <td><img src="/Imagenes/<?php echo $propiedad["imagen"]; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad["precio"];?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"];?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </form>
    </main>

    <?php 
        //5.Cerrar la conexion
        mysqli_close($db);     

        includeTemplate("footer"); 
    ?>