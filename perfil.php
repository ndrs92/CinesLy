<html>
<head>
	<meta charset="utf-8">
	<title>CinesLy - Perfil</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
	<link href="style/style.css" rel="stylesheet" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  					<div class="container container-fluid">
  						<form class="navbar-form navbar-right" role="search">           
  							<a href="perfil.html" class="btn btn-info" >Perfil</a>
  							<a href="amigos.html" class="btn btn-info">Amigos</a>
  							<a href="catalogo.html" class="btn btn-info">Catálogo</a>
  						</form>
  					</div><!-- /.container-fluid -->
  				</nav>
  			</div>
  		</div>
  	</div>
  	<div class="row" margin-top="100px">
  		<div class="container">  
  			<div class="col-md-2 col-md-offset-2">
  				<img src="img/logo.png" width="150px" height="150px" class="img-rounded">
  			</div>
  			<div class="col-md-2" id="test">
  				<table>
  					<tr><td><label for="Nombre Usuario" class="col-lg control-label">Nombre Usuario</label></td></tr>
  					<tr><td><label for="Correo" class="col-lg control-label">Correo</label></td></tr>
  				</table>
  			</div>
  		</div>
  		<form class="form-horizontal" role="form">
  			<div class="form-group" >
  				<label for="contraseña" class="col-lg-2 control-label">Contraseña</label>
  				<div class="col-lg-3">
  					<input type="password" class="form-control" id="contraseña" placeholder="Contraseña">
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="nueva_contraseña" class="col-lg-2 control-label">Nueva Contraseña</label>
  				<div class="col-lg-3">
  					<input type="password" class="form-control" id="nueva_contraseña" placeholder="Nueva Contraseña">
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="repita_contraseña" class="col-lg-2 control-label">Repetir Contraseña</label>
  				<div class="col-lg-3">
  					<input type="password" class="form-control" id="repita_contraseña" placeholder="Repetir contraseña">
  				</div>
  			</div>

  			<div class="form-group">
  				<label for="cambiar_correo" class="col-lg-2 control-label">Cambiar Correo</label>
  				<div class="col-lg-3">
  					<input type="text" class="form-control" id="cambiar_correo" placeholder="Cambiar Correo">
  				</div>
  			</div>
  		</form>
  		<form>
  			<div class="col-md-4 col-md-offset-1">
  				<table class="table table-bordered">
  					<tr>
  						<th colspan="2">Películas recomendadas</th>
  					</tr>
  					<tr>
  						<td><label>Pelicula 1</label></td>
  						<td><input type="checkbox" value="" checked>Eliminar</td>
  					</tr>
  					<tr>
  						<td><label>Pelicula 2</label></td>
  						<td><input type="checkbox" value="" checked>Eliminar</td>
  					</tr>
  					<tr>
  						<td><label>Pelicula 3</label></td>
  						<td><input type="checkbox" value="" checked>Eliminar</td>
  					</tr>
  					<tr>
  						<td><label>Pelicula 4</label></td>
  						<td><input type="checkbox" value="" checked>Eliminar</td>
  					</tr>
  				</table>
  			</div>
  		</form>
  	</div>
  </div>
</div>
</body>