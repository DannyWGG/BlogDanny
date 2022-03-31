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
          <a class="navbar-brand" href="../index.php">Pag. Principal
  </a>
          <a class="navbar-brand btn btn-danger text-white" href="../Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>

        <div class="col-md-3 bg-secondary bg-opacity-10">
            <div>
                <?php
                
                $IDpost=$_GET['id'];
                
            $ruta='../files/'.$_SESSION['id'].'/'; // Indicar la ruta
            $filehandle = opendir($ruta); // Abrir archivos de la carpeta
            while ($file = readdir($filehandle)) {
            if ($file != "." && $file != "..") {
                ?>
                    <div class="col-md-12">
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
        
        <div class="col-md-9 bg-secondary bg-opacity-25">
            <?php
            $Poster = "SELECT * FROM poster WHERE id = $IDpost";
                    
            $resultPost = $mysqli->query($Poster);
        
		$rowPoster=$resultPost->fetch_array(MYSQLI_ASSOC);
                
                    ?>
                    <div>
                        <?php
                        $UserAutor = "SELECT * FROM usuarios WHERE id = $rowPoster[usuario]";
                    
                        $resultAutor = $mysqli->query($UserAutor);
        
                        $rowAutor=$resultAutor->fetch_array(MYSQLI_ASSOC);
                                ?>
                        <div class="col-md-12 bg-secondary bg-opacity-25">
                        <h1 class="text-center"><?php echo $rowPoster['titulo']; ?></h1>
                        </div>
                        <?php
                
                            $ruta='../docs/portada/'.$IDpost.'/'; // Indicar la ruta
                            $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                            
                            while ($file = readdir($filehandle)) {
                            if ($file != "." && $file != "..") {
                            ?>
                        <div class="col-md-6 p-2">
                            <img class="img-thumbnail" <?php echo "src='$ruta$file'" ?>>
                        </div>
                    <?php
                
        } 
                            }
closedir($filehandle); // Fin lectura archivos
?>
                        <div class="col-md-12 bg-secondary bg-opacity-25 p-2">
                        <h1>Autor:<?php echo $rowAutor['usuario']; ?></h1>
                        </div>
                        
                    <div class="formuReg DivNav FuenteYColorNav">
                    <div class="col-md-12 bg-secondary bg-opacity-25 p-2">
                    <a><?php
                    
                                            echo $rowPoster['post'];
                    
                    ?></a>
                    </div>
                    </div>
                    </div>
                        <?php
                
                ?>
        </div>
        
<div class="col-md-12 bg-secondary bg-opacity-25">
            <h3 class="text-center">Publicar Comentario</h3>
<form name="form1" method="post" action="">
  <label for="textarea"></label>
  <center>
    <p>
        <textarea name="comentario" cols="50" rows="4" id="textarea"><?php if(isset($_GET['user'])) { ?>@<?php echo $_GET['user']; ?><?php } ?> </textarea>
    </p>
    <p>
        <input class="btn btn-primary" type="submit"name="comentar" value="Comentar">
    </p>
  </center>
</form>
</div>

<?php
	if(isset($_POST['comentar'])) {
		$sql = "INSERT INTO comentarios (comentario,usuario,fecha,post_id) value ('".$_POST['comentario']."','".$_SESSION['id']."',NOW(),'".$IDpost."')";	
		$query = $mysqli->query($sql);
                if($query) { 
                    header("Location: postDirec.php?id=".$IDpost."");
                }
	}
?>

<?php
	if(isset($_POST['reply'])) {
		$sql = "INSERT INTO comentarios (comentario,usuario,fecha,reply,post_id) value ('".$_POST['comentario']."','".$_SESSION['id']."',NOW(),'".$_GET['id']."','".$IDpost."')";	
		$query = $mysqli->query($sql);
                if($query) { header("Location: postDirec.php?id=".$IDpost.""); }
	}
?>
                
<div class="d-flex justify-content-center row">
    <?php
		
                $comentarios = "SELECT * FROM comentarios WHERE reply = 0 AND post_id = '".$IDpost."' ORDER BY id DESC";
		$result = $mysqli->query($comentarios);
                
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			
			$usuario = "SELECT * FROM usuarios WHERE id = '".$row['usuario']."'";
                        $result2 = $mysqli->query($usuario);
                        $user = $result2->fetch_array(MYSQLI_ASSOC);
		?>
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info">
                        <?php
                
            $ruta='../files/'.$user['id'].'/'; // Indicar la ruta
            $filehandle = opendir($ruta); // Abrir archivos de la carpeta
            while ($file = readdir($filehandle)) {
            if ($file != "." && $file != "..") {
                ?>
                    <div class="col-md-1">
                        <img class="img-thumbnail" <?php echo "src='$ruta$file'" ?>>
                    </div>
                        <?php
                
                } 
                } 
                closedir($filehandle); // Fin lectura archivos
                ?>
                        <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name"><?php echo $user['usuario']; ?></span><span class="date text-black-50">Publicado - <?php echo $row['fecha']; ?></span></div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text"><?php echo $row['comentario']; ?></p>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor">
                            <?php
                    
                        if($user['id']==$_SESSION['id']){ ?>
                            
                            <a class="btn btn-danger u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="../FuncionesInfo/EliminarComnt.php?id=<?php echo $row['id'];?>&post=<?php echo $IDpost;?>" class="userlink">
                        <?php
                        
                    echo 'Eliminar comentario'; } ?></a><span class="ml-1">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>        
</div>
</div>
        
    </body>
    
</html>

