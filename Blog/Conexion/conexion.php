<?php

    $mysqli= new Mysqli('sql310.epizy.com','epiz_31412779','TqsuawxaLVY4eUt','epiz_31412779_blog');
    
    if($mysqli->connect_error){
        die('error en la conexion'.$mysqli->connect_error);
    }

?>


