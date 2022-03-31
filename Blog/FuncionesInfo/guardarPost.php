<?php

        session_start();
        require '../Conexion/conexion.php';

        if(!isset($_SESSION['usuario'])) {
        header('../index.php');
	//header("Location: login.php");
        }
        

        $titulo=$_POST['titulo'];
        $post=$_POST['post'];
        $idPersona=$_SESSION['id'];
        
        $sql = "INSERT INTO poster (post, usuario, fecha_post, titulo) VALUES ('$post', '$idPersona', NOW(), '$titulo')";
        $resultado = $mysqli->query($sql);
        $id_insert=$mysqli->insert_id;

        //imagenprincipal
        
        if($_FILES["archivoPortada"]["error"]>0){
            echo 'error al cargar el archivo';
        }
        else{
            $permitidos=array("image/png","image/jpg","image/jpeg");
            $limitekb=200;
            
            if(in_array($_FILES["archivoPortada"]["type"], $permitidos) && $_FILES["archivoPortada"]["size"] <= $limitekb * 1024){
                
                $ruta='../docs/portada/'.$id_insert.'/';
                $archivoPP=$ruta.$_FILES["archivoPortada"]["name"];
                
                if (!file_exists($ruta)) {
                    mkdir($ruta);
                }
                
                if (!file_exists($archivoPP)) {
                    
                    $resultado2=@move_uploaded_file($_FILES["archivoPortada"]["tmp_name"], $archivoPP);
                    
                    if ($resultado2) {
                        
                        echo 'archivo guardado';
                    }
                    else{
                        echo 'error al guardar archivo';
                    }
                    
                }else{
                    echo 'archivo ya existe';
                }
                
            }
            else
            {
                echo 'archivo excede el tamaño';
            }
        }
?>
<!DOCTYPE html>

<html>
    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../ccs/bootstrap.min.css"/>
        <script src="../jquery/jquery-jquery-3.5.1.min.js"></script>
        
        <meta charset="UTF-8">
        <title></title>
    </head>
    
  <body>
    
      <div class="container">
          
          <div class="row">
              <?php
              if ($resultado2) { 
                  
                  header("Location: ../index.php");
                  
                  ?>
              <h2 style="text-align: center">Post Publicado</h2>
              <?php } else{ 
                  
                  header('../index.php');
                  ?>
              <h2 style="text-align: center">ERROR AL Publicar</h2>
              
              <?php }?>


          </div>

      </div>

  </body>
</html>

