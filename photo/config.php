<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ��� ������� ���� ������, �������� $dblocation = "mysql28.noweb.ru"
  // ������ ��������� ������ ��������� ������
  $dblocation = "localhost";
  // ��� ���� ������, �� �������� ��� ��������� ������
  $dbname = "FildStore";
  // ��� ������������ ���� ������
  $dbuser = "idris070";
  // ������
  $dbpasswd = "464636zop";
  // ������ Web-����������
  $version = "1.2.0";

  // ����������� � �������� ���� ������
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$dbcnx)
  {
    echo( "<P>� ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������.</P>" );
    exit();
  }
  // �������� ���� ������
  if (! @mysql_select_db($dbname,$dbcnx) )
  {
    echo( "<P>� ��������� ������ ���� ������ �� ��������, ������� ���������� ����������� �������� ����������.</P>" );
    exit();
  }

  @mysql_query("SET NAMES cp1251");
  // ��������� ��������������� �������, ������� ������� ��������� �� ������
  // � ������ ������ ������� � ���� ������
  function puterror($message)
  {
    echo("<p>$message</p>");
    exit();
  }
?>
