<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // ������� ������� ����������� ��������
  $id_catalog = $_GET['id_catalog'];
  $id_parent = $_GET['id_parent'];
  // ������� ���������� � ������������� �������� ��������
  $result = mysql_query("SELECT * FROM photo WHERE id_catalog = $id_catalog");
  if (!$result) puterror("������ ��� �������� ������");
  while($row = mysql_fetch_array($result))
  {
    // ���������� ����������
    $query = "SELECT big, small, id_photo FROM photo
              WHERE id_photo=".$row['id_photo'];
    $pct = mysql_query($query);
    if($pct)
    {
      if(mysql_num_rows($pct)>0)
      {
        $photo = mysql_fetch_array($pct);
        if(file_exists("../".$photo['big']) && $photo['big'] != "-") unlink("../".$photo['big']);
        if(file_exists("../".$photo['small']) && $photo['small'] != "-") unlink("../".$photo['small']);
      }
    }
  }
  // ��������� SQL-������� �� �������� ������� �� ������ photo � photocat
  $query_photo = "DELETE FROM photocat WHERE id_catalog=$id_catalog";
  $query_photocat = "DELETE FROM photo WHERE id_catalog=$id_catalog";
  if(mysql_query($query_photo) && mysql_query($query_photocat))
  {
    // ������������ �������������� ������� � �������� �����������������
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=$id_parent'>
          </HEAD>";
  }
?>