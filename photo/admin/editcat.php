<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  // �������� ���������� �� ���������� ��� ��������� � ���� ������
  // ������ ��������
  if(empty($_POST['name'])) links($_POST['id_catalog'],
                                  "����������� �������� ��������");
  if(empty($_POST['pos'])) links($_POST['id_catalog'],
                                    "�� ������� ������� ��������");
  // ���������� ����� ������� (hide) ��� �������� (show)
  if($_POST['hide'] == "on") $showhide = "show";
  else $showhide = "hide";
  // �������� ��������� ������� ���������
  $_POST['name'] = str_replace("'","`",$_POST['name']);
  $_POST['description'] = str_replace("'","`",$_POST['description']);
  // ��������� � ��������� SQL-������ �� ����������� ��������
  $query = "UPDATE photocat SET name='".$_POST['name']."',
                               description='".$_POST['description']."',
                               pos=".$_POST['pos'].",
                               hide='$showhide'
            WHERE id_catalog=".$_POST['id_catalog'];
  if(mysql_query($query))
  {
    // ������������� ������������ ������� �� ������� ��������
    // �����������������
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".$_POST['id_parent']."'>
          </HEAD>";

  } else links($_POST['id_catalog'], "������ ��� ���������� ��������");
  // ������� ������ �������������� � ������ ��������
  function links($id_catalog, $msg)
  {
    echo "<p>".$msg."</p>";
    echo "<p><a href=# onClick='history.back()'>
              ��������� � ������ ��������</a></p>";
    echo "<p><a href=index.php?id_parent=$id_catalog>
              ����������������� ��������</a></p>";
    exit();
  }
?>