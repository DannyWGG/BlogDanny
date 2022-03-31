<?php
session_start();
require '../Conexion/conexion.php';
	
	$id = $_GET['id'];
	$nombre = $_POST['nombre'];
	$pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
	
        if($pass1 == $pass2){
            
            $hash = password_hash($pass1, PASSWORD_DEFAULT);
            
	$sql = "UPDATE usuarios SET usuario='$nombre', contrasena='$hash' WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
        //elimina foto
        function accion($var_id, $var_file){
             $mensaje="Foto Eliminada";
             unlink("../files/$var_id/$var_file");
        }
        
        $mensaje="";
        
        $path="../files/".$id;
            if(file_exists($path))
            {
                $directorio= opendir($path);
                    while ($archivo = readdir($directorio)) 
                    {
                        if (!is_dir($archivo)) {
                                                    
                            accion($id, $archivo);
                    }
                    
            }
        }
	if($id != null && $archivo != null){
        accion($id, $archivo);
        }

        
        
        //elimina foto
        
        
        $id_insert=$id;
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
        <script src="../jquery/jquery-3.1.1.min.js"></script>
	<script src="../jquery/bootstrap.min.js"></script>	
        
        <meta charset="UTF-8">
        <title></title>
        </head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado2) { ?>
						<h3>REGISTRO MODIFICADO</h3>
						<?php $_SESSION['usuario']=$nombre; } else { ?>
						<h3>ERROR AL MODIFICAR</h3>
        <?php }} ?>
					
					<a href="../index.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>

