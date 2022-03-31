<?php
session_start();
include "../Conexion/conexion.php";

if(!isset($_SESSION['usuario'])) {
        header('../index.php');
	//header("Location: login.php");
        }

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    
        <head>
        <title>Perfil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once('../plantillas/ccsDirecPP.html'); ?>
    </head>
    <body>
        <div class="container">      
            <div class="row">
            <div class="col-md-12">
      <!-- Fixed navbar -->
      <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">Blog
  </a>
          <a class="navbar-brand" href="../index.php">Pag. Principal
  </a>
          <a class="navbar-brand btn btn-danger text-white" href="../Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>

        <div class="col-md-6 bg-secondary bg-opacity-10">
            <div>
                <?php
                
                    $ruta='../files/'.$_SESSION['id'].'/'; // Indicar la ruta
                    $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                    while ($file = readdir($filehandle)) {
                    if ($file != "." && $file != "..") {
                    ?>
                    <div class="col-md-3">
                    <img class="img-thumbnail" <?php echo "src='$ruta$file'" ?>>
                    </div>
                    <?php
                
                    }
                    } 
                    closedir($filehandle); // Fin lectura archivos
?>
                <label class="form-label"><h1><?php echo $_SESSION['usuario'];?></h1></label> 
            </div>
            
            <br>
            <div class="col-md-12">
                <a class="btn btn-success" href="../FuncionesInfo/ModificarPerfil.php?id=<?php echo $_SESSION['id']; ?>">Editar Perfil</a>
            </div>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success" href="../Perfil/portal.php?id=<?php echo $_SESSION['id']; ?>">Publicar Post</a>
            </div>
            <br>
            <?php if($_SESSION['superu'] != '0'){ ?>
            <div class="col-md-12">
                <a class="btn btn-success" href="../FuncS/ListUsers.php?id=<?php echo $_SESSION['id']; ?>">Gestionar Usuarios</a>
            </div>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success" href="../FuncS/ListPost.php?id=<?php echo $_SESSION['id']; ?>">Gestionar Publicaciones</a>
            </div>
            <?php } ?>
        </div>
        
        <div class="col-md-6 bg-info bg-opacity-25">
            <div class="formuReg">
                <?php
                
                $query = "SELECT * FROM poster WHERE usuario = '".$_SESSION['id']."' ORDER BY id DESC";

                $resultado = $mysqli->query($query);
                while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    ?> 
            </div>
            
            <div class="p-3 d-flex align-items-center border-bottom osahan-post-header bg-primary bg-opacity-25">
                        
                        <div class="font-weight-bold mr-3">
                            <div class="text-justify"><?php echo $row['titulo']; ?></div>
                        </div>
                        <span class="ml-auto mb-auto">
                            <div class="btn-group p-1">
                                
                                <a class="btn btn-light btn-sm rounded" href="postDirec.php?id=<?php echo $row['id'];?>">Entrar</a>
                                <a class="btn btn-warning btn-sm rounded" href="../FuncionesInfo/ModificarPost.php?id=<?php echo $row['id'];?>">Modificar Post</a>
                                <a class="btn btn-danger btn-sm rounded" href="../FuncionesInfo/EliminarPost.php?id=<?php echo $row['id'];?>">Eliminar Post</a>
                            </div>
                            <br />
                            <div class="text-right text-muted pt-1"><?php echo $row['fecha_post']; ?></div>
                        </span>
                    </div>
            
            <div>
                    <?php } ?>
            
            </div>
            
        </div>
            </div>
        </div>
        
    </body>
    
</html>