<?php $page = 7; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<title>BRUNCHEAR - Contacto</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href="styles-media.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<!-- Accordion -->
<script type="text/javascript" src="js/accordion/jquery.accordion.source.js" charset="utf-8"></script>  
<script type='text/javascript' src='js/accordion/jquery.velocity.min.js'></script>
<script type="text/javascript" src="js/accordion/jquery.easing.1.3.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('ul.accordion').accordion();
		});
	
	function mm01() {
	    $("ul#acord ul").css("display", "none");
		}
	function MM_callJS(jsStr) { //v2.0
	  return eval(jsStr)
	  }
</script>

</head>

<body>
<div id="contenedor">
  <div class="header">
    <div class="logo"><a href="index.php"><img src="img/brunchear.png" width="200" height="26" alt="BRUNCHEAR" /></a></div>
    
<!-- Menu -->
<?php include("nav.php"); ?>
<!-- FIN menu -->

  </div>
  <div class="banner_1100 separa_bottom"><img src="ads/banner_afs_1100x150px 11-10.jpg" width="1100" height="150" alt="ADS" /></div>
  <div class="main">
    <div class="contacto">
      <h1>CONTACTO</h1>
      <form id="form1" name="form1" method="post" action="">
        <p>Escribinos!</p>
        <p>&nbsp;</p>
        <p>
          <input name="nombre" type="text" class="contacto_campos" id="nombre" placeholder="*Nombre" required="required" />
          <input name="emal" type="text" class="contacto_campos" id="emal" placeholder="*Email" required="required" />
          <input name="telefono" type="text" class="contacto_campos" id="telefono" placeholder="*Teléfono" required="required" />
          <textarea name="comentario" cols="20" rows="10" required="required" class="contacto_campos" id="comentario" placeholder="*Comentario"></textarea>
          <input name="button" type="submit" class="enviar" id="button" value="Enviar" />
        </p>
      </form>
    </div>
  </div>
  <div class="banner_1100"><img src="ads/banner_gdi_1100x150px 11-10.jpg" width="1100" height="150" alt="ADS" /></div>

  <!-- Foot -->
<?php include("foot.php"); ?>
<!-- FIN foot -->

</div>
</body>
</html>