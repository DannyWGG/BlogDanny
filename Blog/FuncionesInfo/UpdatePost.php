<?php

require '../Conexion/conexion.php';
	
	$id = $_GET['id'];
	$titulo = $_POST['titulo'];
	$post = $_POST['post'];
	
	$sql = "UPDATE poster SET post='$post', titulo='$titulo' WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
        
        //elimina foto
        
        $mensaje="";
        
        $path="../docs/portada/".$id;
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

        function accion($var_id, $var_file){
             $mensaje="Foto Eliminada";
             unlink("../docs/portada/$var_id/$var_file");
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
                
                $ruta='../docs/portada/'.$id_insert.'/';
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
						<?php } else { ?>
						<h3>ERROR AL MODIFICAR</h3>
					<?php } ?>
					
					<a href="../Perfil/perfil.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>

