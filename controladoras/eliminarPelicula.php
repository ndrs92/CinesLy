<?php

include_once "../modelos/pelicula.php";

		
		$idPelicula=$_GET["idPelicula"];
		echo $idPelicula;	
		$resultado = Pelicula::eliminarPelicula($idPelicula);
	

		header("Location: ../adminModificarPelicula.php");

?>
