<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ������������� ���������� � ����� ������
  require_once ("../config.php");
  include "util.php";    
  // �������� - ���������� �� ���������� ��� ��������� � ���� ������
  if(empty($_POST['name'])) links($_POST['id_catalog'],"����������� �������� ����������");
  if(empty($_POST['pos'])) links($_POST['id_catalog'],"�� ������� ������� ����������");
  // ��������� ������ ��� ��� ����������
  if($_POST['hide'] == "on") $showhide = "show";
  else $showhide = "hide";
  // �������� ��������� ������� ���������
  $_POST['name'] = str_replace("'","`",$_POST['name']);
  // �������������� ��������� ����������
  $small = "";
  $big = "";
  ///////////////////////////////////////////////////////////////////////
  // ���� �������� �����������
  ///////////////////////////////////////////////////////////////////////
  // ���� �������� � ���� ��� ����������� ������� ������ "-" 
  // ��� ������ ����������, ������� ���������� ����������
  if (!empty($_FILES['image']['tmp_name']))
  {
    $query = "SELECT small, big, id_photo FROM photo
              WHERE id_photo=".$_POST['id_photo'];
    $pct = mysql_query($query);
    if(!$pct) links($_POST['id_catalog'],
                    "������ ��������� � ���� ������"); 
    if(mysql_num_rows($pct)>0)
    {
      $photo = mysql_fetch_array($pct);
      // ���� ����� ����������� ���������� - ���������� ���
      if(file_exists("../".$photo['small']) && $photo['small'] != "-")
         unlink("../".$photo['small']);
      // ���� ����������� ����������� ���������� - ���������� ���
      if(file_exists("../".$photo['big']) && $photo['big'] != "-")
         unlink("../".$photo['big']);
    }
    $small = "small = '-',";
    $big = "big = '-',";
  }
  //////////////////////////////////////////////////////////////////////////////
  // ���� �������� �����������
  //////////////////////////////////////////////////////////////////////////////
  // ���� ���� ������ ����������� ��
  // ������ - �������� ��� �� ���������� �������� � ������� /files
  if (!empty($_FILES['image']['tmp_name']))
  {
    // ���������� ���������� �����
    $ext = strrchr($_FILES['image']['name'], "."); 
    // ��������� ���� � �����    
    $image = "files/".date("YmdHis",time())."$ext";
    $smallimage = "files/".date("YmdHis",time())."_s$ext";  
    // ���������� ���� �� ��������� ���������� ������� �
    // ���������� /files Web-����������
    if (copy($_FILES['image']['tmp_name'], "../".$image))
    {
      // ���������� ���� �� ��������� ����������
      unlink($_FILES['image']['tmp_name']);
      // �������� ����� ������� � �����
      chmod("../".$image, 0644);
      $big = " big = '$image',";
    }
    // �������� ������� resizeimg(), ��������� ����������� ����� ����������
    // $image � ���������� � � ���� $smallimage
    if(!resizeimg($image, $smallimage, 133, 100)) links($_POST['id_catalog'],"������ ��� �������� ����������� ����� ����������� � ������� GDLib");
    $small = " small = '$smallimage',";
  }
  // ��������� SQL-������ �� ����������� �������
  $query = "UPDATE photo SET name = '".$_POST['name']."',
                             pos=".$_POST['pos'].",
                             $small
                             $big
                             hide='$showhide' 
            WHERE id_photo=".$_POST['id_photo'];
  if(mysql_query($query))
  {
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".$_POST['id_catalog']."'>
          </HEAD></HTML>";
  } else links($_POST['id_catalog'],"������ ��� ����������� ����������");
  // ��������� ��������������� ������� ��� ������ ��������� � ���� ��������
  function links($id_catalog,$msg)
  {
    echo "<p>".$msg."</p>";
    echo "<p><a href=# onClick='history.back()'>��������� � ������ ����������</a></p>";
    echo "<p><a href=index.php?id_parent=$id_catalog>����������������� �������� ���������</a></p>";
    exit();
  }
?>