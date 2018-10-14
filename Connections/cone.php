<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
session_start();

$hostname_cone = "190.228.29.57";
$database_cone = "basebrunchear";
$username_cone = "userbrunchear";
$password_cone = "sw65df8FDJP0";
$cone = mysql_pconnect($hostname_cone, $username_cone, $password_cone) or trigger_error(mysql_error(),E_USER_ERROR);
?>