<?
    $filename = $_GET['img'];
	$size = getimagesize($filename);
?>
<html>
<head>
<title>�������� ����������</title>
<meta http-equiv="imagetoolbar" content="no">
<style>
 table{font-size: 12px; font-family: Arial, Helvetica, sans-serif; background-color: #F3F3F3;}
</style>
</head>
<body marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0">
<table height="100%" cellpadding="0" cellspacing="0" width="100%" border="1">
  <tr>
    <td height="100%" valign="middle" align="center">
	 ��������� �������� �����������
     <div  style="position: absolute; top: 0px; left: 0px"><img src="<? echo $filename;?>" border="0" <?= $size[3] ?>></div>
    </td>
  </tr>
</table>  	
</body>
</html>