<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);

  // ������������� ���������� � ����� ������
  require_once("../config.php");

  // ��������� �������� �� ����� � ���������
  if(!preg_match("|^[\d]+$|",$_GET['id_catalog'])) exit("������������ ������ URL-������");
  if(!preg_match("|^[\d]+$|",$_GET['id_photo'])) exit("������������ ������ URL-������");

  // ��������� ������� �������� ��������
  $query = "SELECT pos FROM photo
            WHERE id_photo = $_GET[id_photo] AND
                  id_catalog = $_GET[id_catalog]
            LIMIT 1";
  $par = mysql_query($query);
  if(!$par) exit("������ ��� ���������� �������");
  if(mysql_num_rows($par)) $pos_current = mysql_result($par, 0);
  // ��������� ������� ����������� ��������
  $query = "SELECT id_photo, pos FROM photo
            WHERE pos < $pos_current AND
                  id_catalog = $_GET[id_catalog]
            ORDER BY pos DESC
            LIMIT 1";
  $par = mysql_query($query);
  if(!$par) exit("������ ��� ���������� �������");
  if(mysql_num_rows($par))
  {
    $preview = mysql_fetch_array($par);

    $query = "UPDATE photo SET pos = $preview[pos] 
              WHERE id_photo = $_GET[id_photo] AND
                    id_catalog = $_GET[id_catalog]
              LIMIT 1";
    @mysql_query($query);
    $query = "UPDATE photo SET pos = $pos_current
              WHERE id_photo = $preview[id_photo] AND
                    id_catalog = $_GET[id_catalog]
              LIMIT 1";
    @mysql_query($query);
  }
  // ���� ������ �������� ������, ������������ �������������� �������
  // �� ������� �������� �����������������
  echo "<HTML><HEAD>
        <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".htmlspecialchars($_GET['id_catalog'])."'>
        </HEAD></HTML>";
?>