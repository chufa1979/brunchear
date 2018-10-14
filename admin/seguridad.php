<?
session_start();
if(!$_SESSION['user']){
header("Location: index.php?errorusuario=si");
exit;
}
?>