<?php

/**
* 
*/
class Evento
{
	private var $idEvento;
	private var $descripcion;
	private var $mail;
	private var $idSesion;
	private var $idPelicula;
	private var $nombre;

	//usar constructor por defecto
	/*public function __construct($id, $descripcion, $pelicula, $correo, $sesion, $nombre)
	{
		$this->idEvento = $idEvento;
		$this->idPelicula = $pelicula;
		$this->idSesion = $sesion;
		$this->mail = $mail;
		$this->descripcion = $descripcion;
		$this->nombre = $nombre;
	}*/

	public function conectarBD()//función que conecta con la base de datos, será llamada de forma estática
	{
		mysql_connect("localhost","usrCinesLy","AVVeY4MYU6bVXYhJ") or die ('No se pudo conectar'.mysql_error());
		mysql_select_db("CinesLy") or die ('No se pudo conectar a la base de datos');
	}

	public	function consultaBD($consulta)
	{
		$resultado= mysql_query($consulta) or die ('MySql Error en consultaBD'.mysql_error());
		
		return $resultado;
	}

	public function altaEvento($id, $descripcion, $pelicula, $correo, $sesion, $nombre)
	{

		Evento::conectarBD();

		$insertar=INSERT INTO `CinesLy`.`evento` (`id_evento` ,`idPelicula` ,`idSesion` ,`email` ,`descripcion` ,`nombre`)VALUES 
		('$idEvento', '$pelicula', '$sesion', '$correo', '$descripcion', '$nombre')

		$resultado=Evento::consultaBD($insertar);

		if($resultado){

			echo "Evento creado";
		}	 
	}












	/*public function getIdEvento()
	{
		Evento::conectarBD();

		return $this->idEvento;

	}

	public function getDescripcion()
	{

		Evento::conectarBD();

		return $this->descripcion;
	}

	public function getFechaEvento()
	{

		Evento::conectarBD();

		return $this->fechaEvento;

	}

	public function getFechaCreacion()
	{

		Evento::conectarBD();

		return $this->fechaCreacion;

	}		
*/

}