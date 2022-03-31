<?php
	
        session_start();
        
        $idS=$_SESSION['id'];

	require '../Conexion/conexion.php';

	$id = $_GET['id'];
        
        
        //eliminaComentarios
        
        $sql1 = "DELETE FROM comentarios WHERE usuario = '$id'";
	$resultado = $mysqli->query($sql1);
	
        //EliminaPosts
        
	$sql2 = "DELETE FROM poster WHERE usuario = '$id'";
	$resultado2 = $mysqli->query($sql2);

        //elimina Usuario

        $sql3 = "DELETE FROM usuarios WHERE id = '$id'";
	$resultado3 = $mysqli->query($sql3);
        
        header("Location: ../FuncS/ListUsers.php?id=$idS");
	
?>

