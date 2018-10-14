<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BRUNCHEAR | Panel de Administraci&oacute;n Web</title>
<link href="js/style_admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.form-control {width:93%; height:20px;}

</style>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>

<body>
<div class="login-box">
  <form id="form1" name="form1" method="post" action="control.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="logo_login"><img src="img/logo.png" width="217" height="28" alt="VOLVO" /></div>
          <div class="title_login">ADMINISTRADOR </div>
          <div class="login">
            <label>Usuario</label>
        <input name="usuario" type="text" class="form-control" id="usuario" required />
        <label>Contrase&ntilde;a</label>
        <input name="contrasena" type="password" class="form-control" id="contrasena" required />
        <span class="content">
        <br />
        <input name="button2" type="submit" class="btn_ingresar" id="button2"  value="Ingresar" />
    </span> </div>
        </td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>