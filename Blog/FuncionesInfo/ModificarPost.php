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
        <title>Hola</title>
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
          <a class="navbar-brand" href="../Perfil/perfil.php">Perfil
  </a>
        <a class="navbar-brand" href="../index.php">PagPrincipal
  </a>  
          <a class="navbar-brand btn btn-danger text-white" href="../Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>

        <div class="col-md-6 bg-primary bg-opacity-10">
            <div class="col-md-3 p-1">
                <?php
                
                $id = $_GET['id'];
	
                $sql = "SELECT * FROM poster WHERE id = '$id'";
                $resultado = $mysqli->query($sql);
        
                $row = $resultado->fetch_array(MYSQLI_ASSOC);
                
                
                    $ruta='../files/'.$_SESSION['id'].'/'; // Indicar la ruta
                    $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                    while ($file = readdir($filehandle)) {
                    if ($file != "." && $file != "..") {
                    ?>
                
                    <img class="img-thumbnail" <?php echo "src='$ruta$file'" ?>>
                    <?php
                
                    } 
                    } 
                    closedir($filehandle); // Fin lectura archivos
?>
                    <h1>
                <label class="form-label"><?php echo $_SESSION['usuario']; ?></label>
                    </h1>
            </div>
            
        </div>
        
        <div class="col-md-6 bg-primary bg-opacity-25">
            <div class="col-md-12">
                
                <form method="POST" action="UpdatePost.php?id=<?php echo $id;?>" autocomplete="off" enctype="multipart/form-data">
				
                                <div>
					<label for="nombre">Titulo</label>
					<div class="formuReg">
						<input class="form-control" type="text" id="titulo" name="titulo" placeholder="Nombre" value="<?php echo $row['titulo']; ?>" required>
					</div>
				</div>
                                <div>
					<label for="nombre">Post</label>
					<div class="formuReg">
                                            <textarea class="form-control" name="post" cols="50" rows="4" id="post" required><?php echo $row['post']; ?></textarea>
						</div>
				</div>
				
				
                                <div class="col-sm-6">
                                    <label class="form-label">Archivo</label> 
                                    <input type="file" class="form-control" name="archivo" id="archivo" required>
                                    <?php
                                    
                                        $path="../docs/portada/".$id;
                                        if(file_exists($path)){
                                            $directorio= opendir($path);
                                            while ($archivo = readdir($directorio)) {
                                                if (!is_dir($archivo)) {
                                                    
                                                    echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver Archivo Adjunto'>Ver</a>";
                                                    echo "$archivo </div>"; 
                                                    
                                                    ?>
                                    <?php
                                                    echo "<img src='../docs/portada/$id/$archivo' width='100' />";
                                                //accion($id, $archivo);
                                                }
                                            }
                                        }
                                    ?>
                                    </div>

<?php
    /* 
    function accion($var_id, $var_file){
        echo "Foto Eliminada";
    unlink("../files/$var_id/$var_file");
  }
     * 
     */
  
  ?>

                                
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="../index.php" class="btn btn-default bg-warning">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
                                
			</form>
                
            </div>
            
            
        </div>
            </div>
        </div>
        
    </body>
    
</html>