<?php $page = 1; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<title>BRUNCHEAR - Gu&iacute;a</title>
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

<!-- fancyBox -->
<script type="text/javascript" src="js/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();


		$.fancybox.open({
					scrolling : 'auto',
					autoWidth : 'true'
				});
		
	});
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
    <h1><span>ELEG&Iacute;</span> BRUNCHEAR <span>EN TODO EL PA&Iacute;S</span></h1>
    <div class="restos">
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      	<div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    <div class="resto_thumb" style="background-image:url(upload/Aldos.jpg);">
      <div class="transp"><a href="resto.php" class="fancybox fancybox.iframe">ALDO'S</a></div>
    </div>
    </div>
  </div>
  <div class="banner_1100"><img src="ads/banner_gdi_1100x150px 11-10.jpg" width="1100" height="150" alt="ADS" /></div>

  <!-- Foot -->
<?php include("foot.php"); ?>
<!-- FIN foot -->

</div>
</body>
</html>