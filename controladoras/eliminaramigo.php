<?php
include_once "../modelos/usuario.php";
session_start();

$url = $_REQUEST["url"];
$ruta = explode("/", $url);
$aux = explode("?", $ruta[2]);
$resultado = strcmp($aux[0],"amigosAmigo.php");

if( isset($_REQUEST["email"]) ) {

	$flag = $_SESSION["usuario"]->eliminarAmigo($_REQUEST["email"]);
	if($flag){
		if($resultado == 0){
			header("Location: ../".$ruta[2]);
		} else {
			header("Location: ../amigos.php");
		}
	} else {
		echo "Ha habido un error al eliminar tu amigo. ";
	}

} else {

	echo "Ha habido un error al eliminar un amigo";

}

?>