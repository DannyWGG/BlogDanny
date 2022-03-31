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
        <a class="navbar-brand" href="../index.php">PagPrincipal
  </a>  
          <a class="navbar-brand btn btn-danger text-white" href="../Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>
                
        <div class="col-md-6">
            <div class="col-md-12 bg-info bg-opacity-25">
                <?php
                
                $id = $_GET['id'];
	
                $sql = "SELECT * FROM usuarios WHERE id = '$id'";
                $resultado = $mysqli->query($sql);
        
                $row = $resultado->fetch_array(MYSQLI_ASSOC);
                
                
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
                <h1><?php echo $_SESSION['usuario']; ?></h1>
            </div>
            
        </div>
        
        <div class="col-md-6 bg-info bg-opacity-50">
            <div class="col-md-12">
                
                <form method="POST" action="UpdatePerfil.php?id=<?php echo $id;?>" autocomplete="off" enctype="multipart/form-data">
				
                                <div>
					<label for="nombre">Usuario</label>
					<div class="formuReg">
						<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['usuario']; ?>" required>
					</div>
				</div>
                                <div>
					<label for="nombre">Contraseña</label>
					<div class="formuReg">
                                            <input class="form-control" type="password" id="pass1" name="pass1" placeholder="pass" value="" required>
					</div>
				</div>
                                <div>
					<label for="nombre">Confirmar Contraseña</label>
					<div class="formuReg">
                                            <input class="form-control" type="password" id="pass2" name="pass2" placeholder="pass" value="" required>
					</div>
				</div>
				
				
                                <div class="col-sm-12">
                                    <label class="form-label">Archivo</label> 
                                    <input class="form-control" type="file" class="form-control" name="archivo" id="archivo">
                                    <?php
                                    
                                        $path="../files/".$id;
                                        if(file_exists($path)){
                                            $directorio= opendir($path);
                                            while ($archivo = readdir($directorio)) {
                                                if (!is_dir($archivo)) {
                                                    
                                                    echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver Archivo Adjunto'>Ver</a>";
                                                    echo "$archivo </div>"; 
                                                    
                                                    ?>
                                    <?php
                                                    echo "<img src='../files/$id/$archivo' width='300' />";
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

                                
				<div>
                                    <div>
                                            <a class="btn btn-warning" href="../index.php">Regresar</a>
                                            <button class="btn btn-success" type="submit">Guardar</button>
					</div>
				</div>
                                
			</form>
                
            </div>
            
            
        </div>
            </div>
        </div>
        
    </body>
    
</html>