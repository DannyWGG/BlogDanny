<?php
session_start();
include "../Conexion/conexion.php";

if(isset($_SESSION['usuario'])) {
	header("Location: index.php");
}

ini_set('error_reporting',0);
?>

<!DOCTYPE html>
<html>
    
        <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../ccs/bootstrap.min.css"/>
        <script src="jquery/jquery-3.5.1.min.js"></script>
	<script src="jquery/bootstrap.min.js"></script>	
        
        <link rel="stylesheet" type="text/css" href="ccs/jquery.dataTables.min.css"/>
        <script src="jquery/jquery.dataTables.min.js"></script>
        
        <meta charset="UTF-8">
        <title></title>
        </head>
    <body>
        <div class="container">      
            <div class="row">
            <div class="col-md-12">
      <!-- Fixed navbar -->
      <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">Blog
  </a>
          <a class="navbar-brand" href="../index.php">Registrarse
  </a>
</nav>
</div>
        <div class="col-md-6">
            <img class="img-thumbnail" src="../ImagenPrincipal/60d2611d72314.jpeg">
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
            
            <form action="#" method="POST">

            <div>
              <label class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
            </div>
            <div class="formuReg">
                <label class="form-label">Contraseña</label> 
                <input type="password" class="form-control" name="pass" id="pass" placeholder="" value="" required>
            </div>
            <div>
                <br>
                <input class="btn btn-info" type="submit" name="Inicio" id="Inicio" value="Iniciar Sesión" />
            </div>
            </form>
        </div>
        
    </body>
    
</html>

<?php
if($_POST['Inicio']) {

	$email = $_POST['email'];
	$contrasena = $_POST['pass'];
	
	$query = "SELECT * FROM usuarios WHERE email = '$email'";

	$resultado = $mysqli->query($query);
        
        $rowBuscar = $resultado->fetch_array(MYSQLI_ASSOC);
        
        if($rowBuscar > 0){

		if(password_verify($contrasena,$rowBuscar['contrasena'])){
                        
                        $_SESSION['usuario'] = $rowBuscar['usuario'];
				
				$_SESSION['id'] = $rowBuscar['id'];
				
				$_SESSION['superu'] = $rowBuscar['superu'];
				
				header("Location: ../index.php");
		}
		else{
			echo "El nombre de usuario y/o contrasena no coinciden";
		}
	}
}
?>