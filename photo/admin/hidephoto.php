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
  $query = "UPDATE photo SET hide='hide' 
            WHERE id_photo=".$_GET['id_photo'];
  if(mysql_query($query))
  {
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".$_GET['id_catalog']."'>
          </HEAD>";
  } else puterror("������ ��� �������� ���������� ����������");
?>