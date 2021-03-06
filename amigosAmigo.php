<html>
	<head>
		<?php

		include_once "sesion_segura.php";
		include_once "cabecera.php";


		if(!$_REQUEST["email"]){
			header("Location: pantallaPrincipal.php");
		}else{
			if($_REQUEST["email"] == $_SESSION["usuario"]->email){
				header("Location: perfil.php");
			}
		}

		$url = $_SERVER['PHP_SELF']."?email=".$_REQUEST["email"];  
		$server = $_SERVER["SERVER_NAME"]; 

		$amigo = Usuario::getObjetoUsuario($_REQUEST["email"]);

		?>
		<title>Perfil de <?php echo $amigo->nombreUsuario; ?> - CinesLy</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">	
		<link rel="stylesheet" href="js/alertify/themes/alertify.core.css" />
		<link rel="stylesheet" href="js/alertify/themes/alertify.default.css" />
		<link rel="stylesheet" href="style/style.css">
		<script src="js/alertify/lib/alertify.min.js"> </script>
		<script src="js/general.js"> </script>
	
	</head>
	<body>

		<?php

			cabeceraPantallaPrincipal();

			$cant_reg = 15; 
			$num_pag = $_GET['pagina']; 
			if ($num_pag<1) { 
				$comienzo = 0; 
				$num_pag = 1; 
			} else { 
				$comienzo = ($num_pag-1)  * $cant_reg; 
			}
			
		?>


		<h1 class="tackle-right"><?php echo $text["h1Perfil"];?><?php echo $amigo->nombreUsuario; ?></h1>
		<p class="tackle-right"><?php echo $text["pAmigosAm"];?> <?php echo $amigo->nombreUsuario; ?><?php echo $text["pAmigosAm1"];?><a href="amigos.php"><?php echo $text["pAmigosAm2"];?></a>!</p>




		<div class="col-md-3" >

			<div class="panel panel-default " >
				<div class="panel-heading "><?php echo $text["perfil"];?></div>
				<div class="panel-body">
					<?php
					if (isset($amigo->foto)){
						echo "<img src='".$amigo->foto."' width='150px' class='center-block'>";
					}else{
						echo "<img src='img/default_user.png' width='150px' class='center-block'>";
					}
					?>
					<h5><?php echo $text["nomUsu"];?></h5>
					<small><?php echo $amigo->nombreUsuario; ?></small>
					<h5><?php echo $text["email"];?></h5>
					<small><?php echo $amigo->email; ?></small>
					<h5><?php echo $text["biografia"];?>:</h5>
					<textarea disabled class="form-control eslogan"><?php echo $amigo->eslogan; ?></textarea>
				</div> 
				<div class="panel-footer">
				<?php							
					$estadoA = $_SESSION['usuario']->estadoAmistad($amigo->email);	
					switch ($estadoA) {
					    case 0:
					        ?> 
					        <input type="button" class="btn btn-danger pull-right border-radius-publi" style="width:150px" onclick="pruebaEliminar('<?php echo $amigo->email; ?>','<?php echo $server.$url; ?>')" value="<?php echo $text["delAmi"];?>"> 
						    <?php
					        break;
					    case 1:
					    	?>
					    	<form role='form' style="margin:0px;" action='controladoras/cancelarAmigo.php'>
				    	    	<input type="hidden" name="email" value="<?php echo $amigo->email; ?>">
				    	    	<input type="hidden" name="url" value="<?php echo $server.$url; ?>">
					        	<input type='submit' class='btn btn-primary pull-right border-radius-publi' style='width:150px' value="<?php echo $text["cancSol"];?>">
					       	</form>
					        <?php
					        break;
					    default:
					    	?>
					    	<form role='form' style="margin:0px;" action='controladoras/addamigo.php'>
				    	        <input type="hidden" name="email" value="<?php echo $amigo->email; ?>">
				    	        <input type="hidden" name="url" value="<?php echo $server.$url; ?>">
						        <input type="submit" class='btn btn-success pull-right border-radius-publi' style='width:150px' value="<?php echo $text["agregarAm"];?>">
					    	</form>
					        <?php
					        break;
					}
					?>          
	<div class="clearfix"></div>
				</div>	
			</div>			

		</div>

		<div class="col-md-9" >
			<div class="panel panel-default" style="text-align:center;" >
				<ul class="media-list">
					<?php 
					$total_registros = $amigo->numAmigos();

					$amigos=$amigo->paginadorAmigos($_SESSION['usuario']->email,$comienzo,$cant_reg); 

					$total_paginas = ceil($total_registros/$cant_reg);

					while($row = mysql_fetch_array($amigos)){
						?>
						<li class="media" style="margin-top:0px;">
							<div class="well" style="margin-bottom:0px;">


								<div class="amigos-body" >
									<div style="width:20%;float:left;margin-right:10px;">
										<a  href="perfilAmigo.php?email=<?php echo $row['email']; ?>">
											<?php
											if (isset($row['foto'])){
												echo "<img src='".$row['foto']."' width='75px' class='center-block'>";
											}else{
												echo "<img src='img/default_user.png' width='75px' class='center-block'>";
											}
											?>
										</a>			

										<p class="small"><?php echo $row['nombreUsuario']; ?></p>
										<p class="small"><?php echo $row['email']; ?></p>
										
									</div>


									<textarea name="publi" style="width:60%;float:left;cursor:pointer;" readonly id= "<?php echo $row['email']; ?>" class="form-control publi publicacion-text border-radius-publi"  ><?php echo $row['eslogan']; ?></textarea>
									<?php	
									$estadoB = $_SESSION['usuario']->estadoAmistad($row['email']);
									switch ($estadoB) {
									    case 0:
									        ?> 
									        <input type="button" class="btn btn-danger pull-right border-radius-publi" style="width:150px" onclick="pruebaEliminar('<?php echo $row['email']; ?>','<?php echo $server.$url; ?>')" value="<?php echo $text["delAmi"];?>"> 
  									        <?php
									        break;
									    case 1:
									    	?>
									    	<form role='form' style="margin:0px;" action='controladoras/cancelarAmigo.php'>
								    	    	<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
								    	    	<input type="hidden" name="url" value="<?php echo $server.$url; ?>">
									        	<input type='submit' class='btn btn-primary pull-right border-radius-publi' style='width:150px' value="<?php echo $text["cancSol"];?>">
									       	</form>
									        <?php
									        break;
									    default:
									    	?>
									    	<form role='form' style="margin:0px;" action='controladoras/addamigo.php'>
										    	<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
										    	<input type="hidden" name="url" value="<?php echo $server.$url; ?>">
										        <input type="submit" class='btn btn-success pull-right border-radius-publi' style='width:150px' value="<?php echo $text["agregarAm"];?>">
									        </form>
									        <?php
									        break;
									}
									?>  

								</div>

								
								<hr style="background-color:#E1E1E1;height:1px;">
							</div>
						</li><?php  } ?>
						<hr style="background-color:#1E1E1E;height:1px;">
					</ul>




					<ul class="pagination">


						<?php
						if( $num_pag > 1)
							{ ?>
						<li><a accesskey="a" href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag-1); ?>"><?php echo $text["prev"];?></a></li>
						<?php	} else { ?>
						<li class="disabled" ><a href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag) ?>"><?php echo $text["prev"];?></a></li>
						<?php
					}
					if($num_pag<=5){
						for ($i=1; $i<=5; $i++) 
						{ 
							if ($num_pag == $i) 
							{ 
								?><li class="active"><a class="style1"><?php echo $num_pag ?><span class="sr-only">(página actual)</span></a></li> 
								<?php 
							} 
							else 
							{ 
								if ($i<=$total_paginas){?>
								<li><a href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo $i ?>"><?php echo $i; ?></a></li> 
								<?php	}else{  ?>
								<li class="disabled"><a><?php echo "&nbsp"; ?></a></li> 

								<?php }
							} 
						}
					} else {
						for ($i=$num_pag-4; $i<=$num_pag; $i++) 
						{ 
							if ($num_pag == $i) 
							{ 
								?><li class="active"><a class="style1"><?php echo $num_pag ?><span class="sr-only">(página actual)</span></a></li> 
								<?php 
							} 
							else 
							{ 
								?><li><a href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li> 
								<?php
							} 
						}

					}
					if(($num_pag+1)<=$total_paginas) 
						{ ?>
					<li><a accesskey="s" href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag+1) ?>" ><?php echo $text["sig"];?></a></li>
					<?php	} else { ?>
					<li class="disabled" ><a href="amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag) ?>"><?php echo $text["sig"];?></a></li>
					<?php
				}	
				?>	</ul>

			</div>
		</div>




		




		<script type="text/javascript">
		function leftArrowPressed() {
			if(<?php echo $num_pag; ?> > 1) {
				location.replace("amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag-1); ?>");
			}
		}
		function rightArrowPressed() {		
			if((<?php echo $num_pag; ?>+1) <= <?php echo $total_paginas;?>) {
				location.replace("amigosAmigo.php?email=<?php echo $amigo->email ?>&pagina=<?php echo ($num_pag+1); ?>");
			} 	
		}
		document.onkeydown = function(evt) {
			evt = evt || window.event;
			switch (evt.keyCode) {
				case 37:
				leftArrowPressed();
				break;
				case 39:
				rightArrowPressed();
				break;
			}
		};
		</script>

		<?php footer(); ?>
		
	</body>

	<script src= "js/jquery-2.1.1.min.js"></script>
	<script src= "bootstrap/js/bootstrap.js"></script>

</html>