<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // ����������� HTML-����� ��� ����������� ������� � �����������
  $titlepage = "�������������� ��������������� �������";
  $button = "���������";
  $action = "editphoto.php";
  $id_photo = $_GET['id_photo'];
  // ��������� � ��������� SQL-������
  $query = "SELECT * FROM photo 
            WHERE id_photo = $id_photo";
  $pht = mysql_query($query);
  if ($pht)
  {
    $photo = mysql_fetch_array($pht);
    $name = $photo['name'];
    $pos = $photo['pos'];
    if($photo['hide'] == "show") $showhide = "checked";
    else $showhide = "";
    include "addphotoform.php";
  }
?>