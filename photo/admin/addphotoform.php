<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  if($title == "") $titlepage=$title = "����������\n����������";
  $helppage='��������� ����������� ���� � ������� ������ "��������". ���� ���������� * �������� ������������� ��� ����������.';
  include "../util/topadmin.php";  
  // ����������� ����������� ���������� �� ���������
  if(!isset($button)) $button = "��������";
  if(!isset($action)) $action = "addphoto.php";
  if(!isset($showhide)) $showhide = "checked";
  // �������� ��������� �� ������ ��������
  $id_catalog = $_GET['id_catalog'];
  $id_photo = $_GET['id_photo'];
  // ���� ������� ����������� ����� �� �������� �����
  // ���������� � �� ������� contacts
  if(!isset($pos))
  {
    $query = "SELECT MAX(pos) AS maxpos FROM photo
              WHERE id_catalog=$id_catalog";
    $maxpos = mysql_query($query);
    if($maxpos)
    {
      if(mysql_num_rows($maxpos)>0) $pos = mysql_result($maxpos,0) + 1;
      else $pos = 1;
    } else $pos = 1;
  }
?>
<table><tr><td>
<p class=boxmenu><a class=menu href="index.php?id_catalog=<? echo $id_catalog; ?>&id_parent=<? echo $id_parent ?>">��������� � ����������������� ���������</a></p>
</td></tr></table>
<form  enctype='multipart/form-data' action=<?php echo $action; ?> method=post>
<table>
<tr><td><p class=zag2>�������� *</td><td><input size=61 class=input type=text name=name value='<?php echo $name; ?>'></td></tr>
<tr><td><p class=zag2>�����������. *</td><td><input class=input type=file name=image></td></tr>
<tr><td><p class=zag2>������� *</td><td><input class=input type=text name=pos value='<?php echo $pos; ?>'></td></tr>
<tr><td><p class=zag2>����������</td><td><input type=checkbox name=hide <?php echo $showhide; ?>></td></tr>
<tr><td></td><td><input class=button type=submit value=<?php echo $button; ?>></td></tr>
<input type=hidden name=id_catalog value=<?php echo $id_catalog; ?>>
<input type=hidden name=id_photo value=<?php echo $id_photo; ?>>
</table>
</form>
<?php
  include "../util/bottomadmin.php";  
?>