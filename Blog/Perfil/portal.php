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
          <a class="navbar-brand" href="perfil.php">Perfil
  </a>
        <a class="navbar-brand" href="../index.php">PagPrincipal
  </a>  
          <a class="navbar-brand btn btn-danger text-white" href="../Login/logout.php">Cerrar Sesión
  </a>
</nav>
</div>

        <div class="col-md-6">
            <img class="img-thumbnail" src="../ImagenPrincipal/trabajo-remoto-en-la-administracion-publica-1024x576.jpg">
        </div>
        <div class="col-md-6 bg-info bg-opacity-10">
            <form action="../FuncionesInfo/guardarPost.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="formuReg">
                <label class="form-label">Titulo Del Post</label> 
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="" value="" required>
            </div>			
                    <div class="formuReg">
                <label class="form-label">Foto de Portada</label>
                <br>
                <input class="form-control" type="file" class="form-control" name="archivoPortada" id="archivoPortada" required>
            </div>
                

            <div class="formuReg">
                <p>
                    <label class="form-label">InfoPost</label> 
                    <textarea class="form-control" name="post" cols="50" rows="4" id="post" required></textarea>
                </p></div>

            <div class="CentroBoton">
                <button class="btn btn-primary" type="submit">Cargar Post</button>
            </div>
            </form>
        </div>
            </div>
        </div>
        
    </body>
    
</html>

