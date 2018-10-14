<?php require_once('../Connections/cone.php'); 

$colname2_ru = "2";
if (isset($_POST['contrasena'])) {
  $colname2_ru = (get_magic_quotes_gpc()) ? $_POST['contrasena'] : addslashes(trim($_POST['contrasena']));
}
$colname_ru = "1";
if (isset($_POST['usuario'])) {
  $colname_ru = (get_magic_quotes_gpc()) ? $_POST['usuario'] : addslashes(trim($_POST['usuario']));
}
mysql_select_db($database_cone, $cone);
$query_ru = sprintf("SELECT * FROM brunchear_usuarios WHERE `usuario` = '%s' ", $colname_ru);
$ru = mysql_query($query_ru, $cone) or die(mysql_error());
$row_ru = mysql_fetch_assoc($ru);
$totalRows_ru = mysql_num_rows($ru);

if ($totalRows_ru == 0) {
	$erroruser=1;
}
//vemos si el usuario
if ($totalRows_ru > 0) {
	if ($row_ru['pass']==$colname2_ru) {
		session_start();
		$_SESSION['user']=$row_ru['usuario'];
		$_SESSION['nivel']=$row_ru['nivel'];
		$_SESSION['nombreapellido']=$row_ru['nombreapellido'];
		/////////////////////////////////////////
		header("location:home.php?".SID);
	} else { 
		$errorpass=1; 
	}
} 

if ($erroruser==1){
header("Location: home.php?errorusuario=1"); 
}
if ($errorpass==1){
header("Location: home.php?errorusuario=2"); 
}
?>