<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  $title = $titlepage = "�����������";
  // ������������� ���������� � ����� ������
  require_once ("config.php");
  // ������� ����� ��������
  //include "util/topadmin.php";
  // ��������� �� ������ ������� �������� id_parent
  $id_parent = $_GET['id_parent'];
  if(empty($id_parent)) $id_parent = 0;
  if(!preg_match("|^[\d]+$|",$id_parent) && !empty($id_parent)) exit();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?php echo $titlepage; ?></title>
<link rel="StyleSheet" type="text/css" href="util/admin.css">
<script language="" src="photo.js"></script></head>
<body leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" topmargin="0" >
<br><br><table width=100%><tr><td width=10%>&nbsp;</td><td>
<table border="0" width="100%">
<tr><td>
  <table cellspacing="8" cellspacing="0" border=0><tr>
    <tr>
<?php
  // ���� ������� ������� �� �������� ��������,
  // ������� ������ ��� �������� � ���������� ����
  if ($id_parent != 0)
    echo "<td ><p><a class=menu href=index.php?id_parent=0>������� �������</a></p></td>";
  ?>
  </tr></table>
  <table class=bodytable border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>     
  <?
  // ��������� � ��������� SQL-������, �����������
  // ������ ����� ����������
  $query = "SELECT photocat.id_catalog AS id_catalog,
                   photocat.name AS name,
                   COUNT(photo.id_photo) AS total 
            FROM photocat, photo
            WHERE photo.id_catalog = photocat.id_catalog AND photocat.hide = 'show' AND photo.hide = 'show'
            GROUP BY photocat.id_catalog";
  $ctg = mysql_query($query);
  if (!$ctg) puterror("������ ��� ��������� � �����������");
  // ���� � ������� catalog ������������ ���� �� ����
  // ������ ���������� - ������� �� � �������
  if(mysql_num_rows($ctg)>0)
  {
    // ������� ��������� ������� ����� ����������
    echo "<tr class='tableheadercat'>
            <td align=center><p class=zagtable>�������� ������ ����������</td>
            <td>&nbsp;</td>
          </tr>";
    while($cat = mysql_fetch_array($ctg))
    {
      // ������� ������ ���������
      echo "<tr>
              <td><p><a href=index.php?id_parent=".$cat['id_catalog'].">".$cat['name']."</a></td>
              <td><p>".$cat['total']."</td>
            </tr>";
    }
  }
?>
</table>
</td></tr>
<tr><td>
<?php
  // ������� ���������� ����� ����������, ���� ������� ������� �� ��������
  // ��������
  if ($id_parent != 0) include "photos.php";
?>
</td></tr></table>
</td><td width=10%>&nbsp;</td></tr></table>
</body>
</html>