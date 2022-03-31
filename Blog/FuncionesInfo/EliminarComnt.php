<?php
	
	require '../Conexion/conexion.php';
        
	$id = $_GET['id'];
        $post=$_GET['post'];

        
	$sql = "DELETE FROM comentarios WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
        
        header("Location: ../Perfil/postDirec.php?id=$post");
	
?>

