<?php
session_start();
include "../Conexion/conexion.php";

if(!isset($_SESSION['usuario'])) {
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
        
        ?>
        
        <?php require_once('../plantillas/ccsDirecPP.html'); ?>
        
        <div class="container">      
            <div class="row">
            <div class="col-md-12">
      <!-- Fixed navbar -->
      <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">Blog
  </a>
        <a class="navbar-brand" href="../Perfil/perfil.php">Perfil
  </a>  
          <a class="navbar-brand" href="../Perfil/portal.php">Postear
  </a>  
          <a class="navbar-brand btn btn-danger text-white" href="logout.php">Cerrar Sesión
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
                <div class="col-md-2 p-1">
                    <img class="img-thumbnail" <?php echo "src='$ruta$file'" ?>>
                </div>
                    <?php
                
                    } 
                    } 
                    closedir($filehandle); // Fin lectura archivos
?>
                    <label class="p-1">Usuario: <?php echo $_SESSION['usuario']; ?></label> 
            </div>
            <div class="col-md-12 bg-info bg-opacity-25">
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Buscar Post: </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
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
                        <a class="btn btn-outline-info text-black " href="Perfil/postDirec.php?id=<?php echo $rowBuscar['id'];?>">Titulo: <?php
                        echo $rowBuscar['titulo'];
                        
                        ?>
                        </a>
                        <a class="btn btn-outline-info text-black btn-primary" href="../FuncionesInfo/EliminarPost.php?id=<?php echo $rowPoster['id']; ?>">Eliminar Post</a>
                        </div>
                        </div>
                        </div>
                    
                    <?php
            }}}}
            
            ?> 
            
            
        </div>

         <div class="col-md-6">
            <div class="formuReg">
                <?php
                    $Poster = "SELECT * FROM poster WHERE id >= 0 ORDER BY id DESC";
                    
                    $resultPost = $mysqli->query($Poster);
        
		while($rowPoster=$resultPost->fetch_array(MYSQLI_ASSOC)) 
                {
                        ?>
                    <div class="alert alert-info">
                        <div class="container">
                            <div class="alert-icon">
                <a class="btn btn-outline-info text-black" href="../Perfil/postDirec.php?id=<?php echo $rowPoster['id'];?>">Titulo: <?php echo $rowPoster['titulo']; ?></a>
                <a class="btn btn-outline-info text-black btn-primary" href="../FuncionesInfo/EliminarPost.php?id=<?php echo $rowPoster['id']; ?>">Eliminar</a>
                

            </div>
                           

        </div>
                         
            </div>
                <?php } ?> 
        </div>

        <?php
        
        }
        ini_set('error_reporting',0);
        ?>
        
    </body>
    
</html>
