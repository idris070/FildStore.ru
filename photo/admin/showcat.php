<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������ ���������� � ����� ������
  require_once("../config.php");
  // ��������� � ��������� SQL-������ �� �������� ��������
  $query = "UPDATE photocat SET hide='show' 
            WHERE id_catalog=".$_GET['id_catalog'];
  if(mysql_query($query))
  {
    // ������������ �������������� ������� �� ������� ��������
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".$_GET['id_parent']."'>
          </HEAD>";
  } else puterror("������ ��� �������� ��������");
?>