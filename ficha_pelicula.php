<?php 
include_once "sesion_segura.php";
include_once "cabecera.php";
?>

<html lang="es">
<head>
 <meta charset="utf-8">
 <title>Ficha de Película</title>

 <meta http-equiv="X-UA-Compatible" content="IE=edge">     
 <meta name="viewport" content="width=device-width, initial-scale=1">    
 <link rel="stylesheet" href="bootstrap/css/bootstrap.css"  />     
 <link rel="stylesheet" href="style/style.css"  />
 <link rel="stylesheet" href="js/alertify/themes/alertify.core.css" />
 <link rel="stylesheet" href="js/alertify/themes/alertify.default.css" />
 <script src="js/alertify/lib/alertify.min.js"> </script>

</head>

<body>
  <?php 
  cabeceraPantallaPrincipal();  
  $idPeli=$_REQUEST["id"];
  $ObjPeli=Pelicula::getObjetoPelicula($idPeli);

  if($_REQUEST["insertado"] == true){
    ?>
    <script>
      alertify.log('Se ha insertado el comentario correctamente', 'success', 3000);
    </script>
    <?php
  }

  ?>

<h1 class="tackle-right"><?php echo $text["h1FichaPel"];?>"<?php echo "$ObjPeli->titulo"; ?>"</h1>
<p class="tackle-right"><?php echo $text["pFichaPel"];?>"</p>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 top-margin">

       <?php 
       if(  substr($ObjPeli->foto, 0,3) == "img" ){
        echo "<img src='".$ObjPeli->foto."' alt='null' height='360px' width='100%' class='thumbnail'>";
      }else {echo "<tr><td class='col-md-1'><img src='img/movie_no_poster.jpg' width='100%' /></td>";}
      ?>


    </div>
    <div class="col-lg-9">
     <div class="panel panel-default top-margin">
       <div class="panel-heading text-weight-bold"><?php echo $text["divFichaPel"];?>"</div>
       <div class="panel-body">
        <div class="row-fluid">
          <div class="span6">
            <div class="direction-box top-margin-little">    
              <ul>
                <li class="list-no-deco"><strong class="step"><?php echo $text["titulo"];?>" </strong><?php echo "$ObjPeli->titulo"; ?></li>
                <li class="list-no-deco"><strong class="step"><?php echo $text["director"];?>" </strong><?php echo "$ObjPeli->director"; ?></li>
                <li class="list-no-deco"><strong class="step"><?php echo $text["actores"];?>" </strong><?php echo "$ObjPeli->actores"; ?></li>
                <li class="list-no-deco"><strong class="step"><?php echo $text["distr"];?>" </strong><?php echo "$ObjPeli->distribuidora"; ?></li>
                <li class="list-no-deco"><strong class="step"><?php echo $text["duracion"];?>" </strong><?php echo "$ObjPeli->duracion";  ?></li>
                <!--<li><strong>Apta</strong> para todos los públicos.</li></ul>-->
              </ul>
              <strong> <?php echo $text["valorar"];?></strong>
              <div class="btn-group" role="group" aria-label="...">
                <form action="controladoras/procesarValoracion.php" method="POST">
                  <?php $_SESSION['idPelicula']=$ObjPeli->idPelicula;?>
                  <input type="submit" name="Valor" value="1">
                  <input type="submit" name="Valor" value="2">
                  <input type="submit" name="Valor" value="3">
                  <input type="submit" name="Valor" value="4"> 
                  <input type="submit" name="Valor" value="5">    
                </form>

              </div>   
                <button type="button" class="btn btn-default" onclick="alertify.success('Recomendación guardada con éxito')"><strong><?php echo $text["recomendar"];?><strong></button>  
                
               <div>
                <?php
                
                    $valoracionMedia = $ObjPeli->valoracion / $ObjPeli->contValoracion;
                    echo "".$text['valMed']. " " .round($valoracionMedia,2)."";
              
                    
                ?>
              </div> 
                <!--<?php 
                   Pelicula::recomendarPelicula($_SESSION["usuario"]->email, $ObjPeli->idPelicula);
                ?>-->
            </div>
           
          </div>
        </div>
      </div>
          
          <div class="top-margin">
            <div class="share-box-outer">
              <div class="panel panel-default">
                <div class=" text-weight-bold panel-heading"><?php echo $text["comentarios"];?>"</div>
                <div class="panel-body" >
                 <div class="input-group col-md-11" style="margin-left: -10px;" >
                   <span class="input-group-btn ">
                    <form method="POST" action="controladoras/inserComentPelControlador.php" >
                      <input type="hidden" value="<?php echo $ObjPeli->idPelicula; ?>" name="idPeli"/>
                      <input type="text" class="form-control" placeholder="<?php echo $text["writeComen"];?>" name="coments"/>
                      <input type="submit" class="btn btn-info" value="<?php echo $text["publicar"];?>"/>          
                    </form>
                  </span>
                </div>
              </div>
              <ul class="media-list">
                <?php           

                $arrayComentarios=Pelicula::getComentariosPelicula($ObjPeli->idPelicula);
                $arrayUsuarios=$arrayComentarios['usuario'];
                $arrayComents=$arrayComentarios['comentario'];

                for($i=0; $i<sizeof($arrayComents); $i++){
                 $usuActual = Usuario::getObjetoUsuario($arrayUsuarios[$i]);
                 $cmtActual = $arrayComents[$i];

                 ?>

                 <li class="media">
                  <div class="well">
                    <a class="media-left" href="perfilAmigo.php?email=<?php echo $usuActual->email; ?>">
                      <?php

                      if(isset($usuActual->foto)){
                        echo "<img src='$usuActual->foto' alt='' height='50px' width='50px' class='thumbnail'>";

                      }else{
                        echo "<img src='img/default_user.png' alt='' height='50px' width='50px' class='thumbnail'>";

                      }

                      ?>
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading"><?php echo $usuActual->nombreUsuario; ?></h4>
                      <p><?php echo $cmtActual; ?></p>
                    </div>
                  </div>
                </li>

                <?php
              }
              ?>
            </div>
          </ul>
        </div>
      </div>
    </div>


  </div>
</div>
</div>
</div>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/valoracion.min.js"></script>

  <?php footer(); ?>

</body>