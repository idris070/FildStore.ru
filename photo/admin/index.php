<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  $title = $titlepage = "����������\n������������";
  $helppage = '���� � ��� �� �������� ��� Web-����������, �� ������ ������ ����� ������ �� ��� ��������� � ��������� �� ����� ������ <a href=http://www.softtime.ru/forum/>http://www.softtime.ru/forum/</a> �������� ��� ����� ����������� �������������� ����������������, � ���� ������ �� ����� ������ �������� ��� ����� � ���������� ���� �����������. ���� ���� ����������� ������������� ��������� � ���������, �� ���������� ���������� � ������ ����� ���������.';
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // ������� ����� ��������
  include "../util/topadmin.php";
  // ��������� �� ������ ������� �������� id_parent
  $id_parent = $_GET['id_parent'];
  if(empty($id_parent)) $id_parent = 0;
?>
<table border="0" width="100%">
<tr><td>
  <table cellspacing="8" cellspacing="0" border=0><tr>
    <tr>
<?php
  // ���� ������� ������� �� �������� ��������,
  // ������� ������ ��� �������� � ���������� ����
  if ($id_parent != 0)
    echo "<td ><p><a class=menu href=index.php?id_parent=0>������� �������</a></p></td>";
  // ���� ������� �������� �������� - ������� ������ ��� ���������� �����������
  else echo "<td><p><a class=menu href=addcatform.php?id_parent=0>�������� ������ ����������</a></td>";
  ?>
  </tr></table>
  <table class=bodytable width="100%" border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>     
  <?
  // ��������� � ��������� SQL-������, �����������
  // ������ ����� ����������
  $query = "SELECT * FROM photocat 
            WHERE id_parent=$id_parent 
            ORDER BY pos";
  $ctg = mysql_query($query);
  if (!$ctg) puterror("������ ��� ��������� � �����������");
  // ���� � ������� catalog ������������ ���� �� ����
  // ������ ���������� - ������� �� � �������
  if(mysql_num_rows($ctg)>0)
  {
    // ������� ��������� ������� ����� ����������
    echo "<tr class='tableheadercat'>
            <td align=center><p class=zagtable>�������� ������ ����������</td>
            <td width=20 align=center><p class=zagtable>���.</td>
            <td colspan=3 align=center><p class=zagtable>��������</td>
          </tr>";
    while($cat = mysql_fetch_array($ctg))
    {
      // �������� ����� ������� ��� ���
      $stylerow="";
      if($cat['hide'] == "hide")
      {
        $strhide = "<a href=showcat.php?id_catalog=".$cat['id_catalog']."&id_parent=$id_parent>����������</a>";
        $stylerow="class='hiddenrow'";
      } else $strhide = "<a href=hidecat.php?id_catalog=".$cat['id_catalog']."&id_parent=$id_parent>������</a>";
      // ������� ������ ���������
      echo "<tr $stylerow >
              <td><p><a href=index.php?id_parent=".$cat['id_catalog'].">".$cat['name']."</a></td>
              <td><p>".$cat['pos']."</td>
              <td align=center><p>$strhide</td>
              <td align=center><p><a href=editcatform.php?id_catalog=".$cat['id_catalog']."&id_parent=$id_parent>���������</a></td>
              <td align=center><p><a href=delcat.php?id_catalog=".$cat['id_catalog']."&id_parent=$id_parent>�������</a></td>
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
<?php
  include "../util/bottomadmin.php";  
?>