<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  if($titlepage == "") $titlepage=$title = "���������� ������ ����������";
  include "../util/topadmin.php";  
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // ������������� ����������� ���������� ����� �� ���������
  if(!isset($title)) $title = "���������� ������ ��������";
  if(!isset($button)) $button = "��������";
  if(!isset($action)) $action = "addcat.php";
  if(!isset($showhide)) $showhide = "checked";
  // ��������� ���������� ���������
  $id_catalog = $_GET['id_catalog'];
  $id_parent = $_GET['id_parent'];
  // ���� ������� �������� �� ��������
  // ��������� �������� ��������� �������
  if(!isset($pos))
  {
    $query = "SELECT MAX(pos) FROM photocat
              WHERE id_parent=".$_GET['id_parent'];
    $num = mysql_query($query);
    if($num)
    {
      if(mysql_num_rows($num)>0) $pos = mysql_result($num,0) + 1;
      else $pos = 1;
    } else $pos = 1;
  }
?>
<table><tr><td>
<p class=boxmenu><a class=menu href="index.php?id_catalog=<? echo $id_catalog; ?>&id_parent=<? echo $id_parent ?>">��������� �� �������� �����������������</a></p>
</td></tr></table>
<form enctype='multipart/form-data' action=<?php echo $action; ?> method=post>
<table>
<tr><td><p class=zag2>��������</td><td><input style="font-weight: bold" size=61 class=input type=text name=name value='<?php echo $name; ?>'></td></tr>
<tr><td><p class=zag2>�������</td><td><input size=5 class=input type=text name=pos value='<?php echo $pos; ?>'></td></tr>
<tr><td><p class=zag2>����������</td><td><input type=checkbox name=hide <?php echo $showhide; ?>></td></tr>
<tr><td></td><td><input class=button type=submit value=<?php echo $button; ?>></td></tr>
<input type=hidden name=id_catalog value=<?php echo $id_catalog; ?>>
<input type=hidden name=id_parent value=<?php echo $id_parent; ?>>
</table>
</form>
<?php
  include "../util/bottomadmin.php";  
?>