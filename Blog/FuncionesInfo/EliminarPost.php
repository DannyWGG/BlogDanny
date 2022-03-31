<?php
	
	require '../Conexion/conexion.php';

	$id = $_GET['id'];
	
	$sql = "DELETE FROM poster WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
        
        eliminarDir('../docs/portada/'.$id);
        
        function eliminarDir($carpeta)
        {
            
            foreach (glob($carpeta . "/*") as $archivos_carpeta) {
                
                if (is_dir($archivos_carpeta)) {
                    eliminarDir($archivos_carpeta);
                }
                else
                {
                    unlink($archivos_carpeta);
                }
                
            }
            
            rmdir($carpeta);
            
            header("Location: ../Perfil/perfil.php");
            
        }
	
?>

