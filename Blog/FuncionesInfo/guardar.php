<?php

    require '../Conexion/conexion.php';
    
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $contra1=$_POST['pass1'];
    $contra2=$_POST['pass2'];
        
        if($contra1 == $contra2){
            
            $hash = password_hash($contra1, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO usuarios (usuario, contrasena, fecha_reg, email) VALUES ('$nombre', '$hash', NOW(), '$email')";
	$resultado = $mysqli->query($sql);
        
        $id_insert=$mysqli->insert_id;
        if($_FILES["archivo"]["error"]>0){
            echo 'error al cargar el archivo';
        }
        else{
            $permitidos=array("image/gif","image/png","image/jpg","image/jpeg","application/pdf");
            $limitekb=200;
            
            if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limitekb * 1024){
                
                $ruta='../files/'.$id_insert.'/';
                $archivo=$ruta.$_FILES["archivo"]["name"];
                
                if (!file_exists($ruta)) {
                    mkdir($ruta);
                }
                
                if (!file_exists($archivo)) {
                    
                    $resultado2=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
                    
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
              if ($resultado) { ?>
              <h2 style="text-align: center">REGISTRO GUARDADO</h2>
              
              <?php header("Location: ../Login/login.php");  } else{?>
              
              <h2 style="text-align: center">ERROR AL GUARDAR</h2>
              <?php }}?>
              <?php 
              
                   if($contra1 != $contra2){
                   ?>
                        <a href="../index.php" class="btn btn-primary">ERROR AL GUARDAR</a>
                   <?php } ?>
              
              
              
          
          </div>

      </div>

  </body>
</html>



