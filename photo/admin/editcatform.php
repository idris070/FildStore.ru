<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  $titlepage = "�������������� ������ ���������";
  $button = "���������";
  $action = "editcat.php";
  $query = "SELECT * FROM photocat 
            WHERE id_catalog=".$_GET['id_catalog'];
  $cat = mysql_query($query);
  if ($cat)
  {
    $catalog = mysql_fetch_array($cat);
    $name = $catalog['name'];
    $description = $catalog['description'];
    $pos = $catalog['pos'];
  }
  include "addcatform.php";
?>