<?php
session_start();
include "Conexion/conexion.php";

if(!isset($_SESSION['usuario'])) {
        require_once('plantillas/ccsDirecIndex.html');
        require_once('plantillas/MainReg.html');
	//header("Location: login.php");
?>

<!DOCTYPE html>
<html>
    
        <head>
        <title>Blog</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        
        <?php
        
        }else{
            
            //require_once('plantillas/MainLog.html');
            
            //include_once('footer.php');
            require_once('plantillas/ccsDirecIndex.html');
        ?>
        
        <div class="container">      
            <div class="row">
            <div class="col-md-12">
      <!-- Fixed navbar -->
      <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">Blog
  </a>
          <a class="navbar-brand" href="Perfil/perfil.php">Perfil
  </a>
          <a class="navbar-brand" href="Perfil/portal.php">Postear
  </a>
          <a class="navbar-brand btn btn-danger text-white" href="Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>

        <div class="col-md-6 bg-info bg-opacity-10">
            <div class="col-12">
                <div>
                <?php
                
                    $ruta='files/'.$_SESSION['id'].'/'; // Indicar la ruta
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
                </div>
                <label><h1><?php echo $_SESSION['usuario'];?></h1></label> 
            </div>
            <div class="col-6">
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Buscar Post: </b><input class="form-control" type="text" id="campo" name="campo" />
					<input class="btn btn-success" type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
                </form>
            </div>
            
            <?php
            
            $where = "";
	
            if(!empty($_POST))
            {
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE titulo LIKE '%$valor%'";
                        
                        $sqlBuscar = "SELECT * FROM poster $where";
                        $resultadoBuscar = $mysqli->query($sqlBuscar);
                        while($rowBuscar = $resultadoBuscar->fetch_array(MYSQLI_ASSOC)){
                
                        $mystring = $rowBuscar['titulo'];
                        $findme   = '@';
                        $pos = strpos($mystring, $findme);

                        if ($pos === false) { ?>
            
                        <div class="alert alert-info">
                        <div class="container">
                            <div class="alert-icon">
                            <a class="btn btn-primary" href="Perfil/postDirec.php?id=<?php echo $rowBuscar['id'];?>">
                            Entrar</a>
                            <i class="material-icons">Titulo: <?php echo $rowBuscar['titulo']; ?></i>
                            
                            </div>

                        </div>
                        </div>
                    
                    <?php
            }}}}
            
            ?> 
            
            
        </div>
   
         <div class="col-md-6 bg-info bg-opacity-25">
             
             
             
            <div>
                <?php
                    $Poster = "SELECT * FROM poster WHERE id >= 0 ORDER BY id DESC";
                    
                    $resultPost = $mysqli->query($Poster);
        
		while($rowPoster=$resultPost->fetch_array(MYSQLI_ASSOC)) 
                {
                    $contar = "SELECT * FROM usuarios WHERE id = '".$rowPoster['usuario']."'";
                    $resultUser = $mysqli->query($contar);
                    while($rowUser=$resultUser->fetch_array(MYSQLI_ASSOC)){
                        ?>
                
                <div class="p-3 d-flex align-items-center border-bottom osahan-post-header">
                        
                        <div class="font-weight-bold mr-3">
                            <div class="text-truncate">Autor:<?php echo $rowUser['usuario']; ?></div>
                            <div class="small"><?php echo $rowPoster['titulo']; ?></div>
                        </div>
                        <span class="ml-auto mb-auto">
                            <div class="btn-group">
                                
                                <a class="btn btn-light btn-sm rounded" href="Perfil/postDirec.php?id=<?php echo $rowPoster['id'];?>">Entrar</a>

                            </div>
                            <br />
                            <div class="text-right text-muted pt-1"><?php echo $rowPoster['fecha_post']; ?></div>
                        </span>
                    </div>

                <?php }} ?>

            </div>

        </div>
            </div>
        </div>


        
        <?php
        
        }
        ini_set('error_reporting',0);
        ?>
        
    </body>
    
</html>
