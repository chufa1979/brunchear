<?php
require_once('Connections/cone.php');
mysql_select_db($database_cone, $cone);
$query_rsno = "SELECT * FROM brunchear_nota WHERE categoria = '$idcat'";
$rsno = mysql_query($query_rsno, $cone) or die(mysql_error());
$row_rsno = mysql_fetch_assoc($rsno);
$totalRows_rsno = mysql_num_rows($rsno);
$p = 1;
if ($totalRows_rsno<>0) {
?>
<?php do { ?>
  <div class="listado" onclick="window.location = 'post.php?vid=<?php echo $row_rsno['id']; ?>';">
    <div class="num"><?php echo $p;?></div>
    <div class="foto"><img src="<?php echo $row_rsno['imagen']; ?>" alt="Imagen" width="110" height="70" /></div>
    <div class="txt"><?php echo $row_rsno['titulo']; ?></div>
  </div>
  
  
  <?php 
  $p++;
  } while ($row_rsno = mysql_fetch_assoc($rsno)); ?>
<?php
mysql_free_result($rsno);
?>
<?php } else { ?>
No hay notas en esta categoría
<?php } ?>
