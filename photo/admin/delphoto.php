<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // �������� ��������� �� ������ �������
  $id_catalog = $_GET['id_catalog'];
  $id_photo = $_GET['id_photo'];
  // ���������� ����������
  $query = "SELECT big, small, id_photo FROM photo
            WHERE id_photo=$id_photo";
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
  // ��������� � ��������� SQL-������ �� ��������
  // ����������
  $query = "DELETE FROM photo 
            WHERE id_photo = $id_photo";
  if(mysql_query($query))
  {
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=$id_catalog'>
          </HEAD>";
  }
  else
  {
    echo "<a href='index.php?id_parent=$id_parent'>���������</a>";
    echo("<P> ������ ��� �������� ����������</P>");
    echo "<p><b>Error: ".mysql_error()."</b></p>";
    echo $query;
  }
?>