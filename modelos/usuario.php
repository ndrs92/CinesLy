<?php

class Usuario{

	var $nombreUsuario;
	var $email;
	var $pass;
	var $tipoUsuario;
	var $foto;
	var $preferencia1;
	var $preferencia2;
	var $preferencia3;
	var $estado;
	var $ciudadActual;
	var $fechaNacimiento;
	var $eslogan;

	function __construct($nombreUsuario,$email,$pass,$tipoUsuario){
		$this->nombreUsuario=$nombreUsuario;
		$this->email=$email;
		$this->pass=$pass;
		$this->tipoUsuario=$tipoUsuario;
	}

	function __construct($nombreUsuario,$email,$pass,$tipoUsuario,$foto,$preferencia1,$preferencia2,$preferencia3,$estado,$ciudadActual,$fechaNacimiento,$eslogan){
		$this->nombreUsuario=$nombreUsuario;
		$this->email=$email;
		$this->pass=$pass;
		$this->tipoUsuario=$tipoUsuario;
		$this->foto=$foto;
		$this->preferencia1=$preferencia1;
		$this->preferencia2=$preferencia2;
		$this->preferencia3=$preferencia3;
		$this->estado=$estado;
		$this->ciudadActual=$ciudadActual;
		$this->fechaNacimiento=$fechaNacimiento;
		$this->eslogan=$eslogan;
	}

	function conectarBD() {
		mysql_connect("localhost","admin","admin") or die ('No se pudo conectar: '.mysql_error());
		mysql_select_db("CinesLy") or die ('No se pudo seleccionar la base de datos');
	}

	function consultaBD($consulta)
	{
		$resultado = mysql_query($consulta);
		if(!$resultado)	{
			echo 'MySql Error: '.mysql_error();
			exit;
		}
		return $resultado;
	}


public function getObjetoUsuario($email){
		$this->conectarBD();
		$sql="SELECT�*�FROM�usuario�WHERE�email�=�'".$email."'";
		$resultado=$this->consultaBD($sql);
		$row=mysql_num_rows($resultado);

		if($row==1){
			$row=mysql_fetch_array($resultado);
			return new Usuario($row['nombreUsuario'],$row['email'],$row['pass'],$row['tipoUsuario'],$row['foto'],$row['preferencia1'],$row['preferencia2'],$row['preferencia3'],$row['estado'],$row['ciudadActual'],$row['fechaNacimiento'],$row['eslogan']));
}else{
	echo "El usuario no se encuentra registrado.";
}
}

function loguearUsuario(){
	$this->conectarBD();
	$sql="SELECT�email�FROM�usuario�WHERE�email�=�'".$this->email."' AND pass = '".$this->pass."'";
	$resultado=$this->consultaBD($sql);
	$row=mysql_num_rows($resultado);
	if($row==1){
		$row=mysql_fetch_array($resultado);
		session_start();
		$_SESSION['usuario'] = $this->getObjetoUsuario($row['email']);
		if (!(isset($_SESSION['usuario']))) {
			echo "error";
		} else if($_SESSION['usuario']->tipoUsuario==0) {
			header("Location:pantallaPrincipal.php");
		} else if($_SESSION['usuario']->tipoUsuario==1) { 
			header("Location:administrador.php");
		}
	} else {
		header("Location:index.php");
	}
} 

function registrarUsuario(){
	$this->conectarBD();
	$sql="INSERT INTO usuario(nombreUsuario, email, pass, tipoUsuario) VALUES ('".$this->nombreUsuario."','".$this->email."','".$this->pass."',0)";
	$this->consultaBD($sql);
	header("Location:index.php");
}

function bajaUsuario(){
	$this->conectarBD();
	$sql="DELETE FROM usuario WHERE email ='".$this->email."'";
	$this->consultaBD($sql);
	header("location:index.php");
}

function actualizarUsuario($email) {
	$this->conectarBD();
	$sql="UPDATE usuario SET nombreUsuario='".$this->nombreUsuario."' , email='".$this->email."' , pass='".$this->pass."' WHERE email='".$email."'";	
	$this->consultaBD($sql);
	header("Location:index.php");
}

function registrarUsuarioAdmin($nombreUsuario,$email,$pass,$tipoUsuario){
	$this->conectarBD();
	$sql="INSERT INTO usuarios(nombreUsuario, email, pass, tipoUsuario) VALUES ('".$nombreUsuario."','".$email."','".$pass."','".$tipoUsuario."')";
	$this->consult($sql);
	header("Location:administrador.php");
}

function eliminarUsuario(){
	$this->conectarBD();
	$sql="DELETE FROM usuario WHERE email ='".$this->email."'";
	$this->consultaBD($sql);
	header("location:administrador.php");
}

function modificarUsuarioAdmin($email){
	$this->conectarBD();
	$sql="UPDATE usuario SET nombreUsuario='".$this->nombreUsuario."',email='".$this->email."', pass='".$this->pass."', tipoUsuario=".$this->tipoUsuario." WHERE email='".$email."'";
	$this->consultaBD($sql);
	header("location:administrador.php");
}

}

?>