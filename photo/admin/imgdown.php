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
  $img = mysql_query($query);
  if(!$img) exit("������ ��� ���������� �������");
  if(mysql_num_rows($img)) $pos_current = mysql_result($img, 0);
  // ��������� ������� ���������� ��������
  $query = "SELECT id_photo, pos FROM photo
            WHERE pos > $pos_current AND
                  id_catalog = $_GET[id_catalog]
            ORDER BY pos
            LIMIT 1";
  $img = mysql_query($query);
  if(!$img) exit("������ ��� ���������� �������");
  if(mysql_num_rows($img))
  {
    $next = mysql_fetch_array($img);

    $query = "UPDATE photo SET pos = $next[pos] 
              WHERE id_photo = $_GET[id_photo] AND
                    id_catalog = $_GET[id_catalog]
            LIMIT 1";
    @mysql_query($query);
    $query = "UPDATE photo SET pos = $pos_current
              WHERE id_photo = $next[id_photo] AND
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