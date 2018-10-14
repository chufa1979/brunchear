<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BRUNCHEAR | Panel de Administraci&oacute;n Web</title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="js/style_admin.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form id="form1" name="form1" method="get" action="">
  <table width="430" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#FFFFFF"><table width="430" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr valign="top">
          <td height="20" align="right" valign="middle"><a href="#"><img src="img/icon_cerrar.png" alt="Cerrar" width="22" height="20" border="0" onclick="Dialog.okCallback()"/></a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="220" align="center" bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="300" align="center">&iquest;Realmente desea eliminar el Usuario?</td>
          </tr>
        </table>
        <br />
        <table width="230" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%">
            <input name="eliminalinea" type="submit" class="btn_si" id="si" value="SI" />
            </td>
            <td width="50%" align="right">
            <input name="button2" type="button" class="btn_no" id="no" value="NO" onclick="Dialog.okCallback()" /></td>
          </tr>
        </table>
        <span class="rojo">
        <input name="vid" type="hidden" id="vid" value="<?php echo $_GET['vid']; ?>" />
      </span>      </td>
    </tr>
  </table>
</form>
</body>
</html>