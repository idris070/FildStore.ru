<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
?>
  <table cellspacing="8"><tr><td>
  <a class="menu" href=addphotoform.php?id_catalog=<? echo $id_parent ?>>�������� ����������</a>
  </td></tr></table>
  
  <table class=bodytable width="100%" border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>     
<?php
  // �������� �� ���� ������ ����������
  $query = "SELECT * FROM photo 
            WHERE id_catalog=$id_parent 
            ORDER BY pos";
  $prt = mysql_query($query);
  if(!$prt)
  {
    echo "error : ".mysql_error()."<br>";
    echo $query;
    puterror("������ ��� ��������� � ����� �����������");
  }
  // ���� � ������� ������ ���������� ������� ���� �� ����
  // ���������� - ��������� ������� � ������������
  if(mysql_num_rows($prt) > 0)
  {
    // ��������������� ���������� ��� ������
    // ���������� �� 3 ����� � ������
    $td == 0;
    // ������� ��������� �������
    while($par = mysql_fetch_array($prt))
    {
      // �������� ������ ���������� ��� ���
      $styletable="";
      if($par['hide'] == "hide")
      {
         $showhide = "<a href=showphoto.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>����������</a>";
         $styletable="class='hiddenrow'";
      } else $showhide = "<a href=hidephoto.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>������</a>";
      // ��������� ���������� $image, ������� ��������������� �� �����
      // ������������ �����������, ����������� ������� �� �����������
      if(!empty($par['small']) &&
         $par['small']!="-" &&
         file_exists("../".$par['small']))
      {
	    $size = getimagesize("../".$par['big']);
        $image = "<a href=# onclick=\"show_img('".$par['big']."',".$size[0].",".$size[1].",'true'); return false \" ><img src=../".$par['small']." border=0 vspace=3></a>";
      }
      else $small = "���";
      // ���� �������� ��������� ���������� ����� 0
      // ������� ��� ������ ������ ������� <tr>
      if ($td == 0) echo "<tr>";
      // ������� ����������
      echo "<td $styletable><table border=0 width=100%><tr align=center>
              <td colspan=2><p><b>".$par['name']."</b></p></td></tr>
              <tr>
                 <td>$image</td>
                 <td align=center>
                 <p>���:".$par['pos']."
                 <p>$showhide<br>
                 <a href=editphotoform.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>���������</a><br>
                 <a href=delphoto.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>�������</a><br>
                 <a href=imgup.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>�����</a><br>
                 <a href=imgdown.php?id_photo=".$par['id_photo']."&id_catalog=$id_parent>����</a></td>
            </tr></table></td>";
      // ����������� �������� ��������� ���������� $td
      $td++;
      // ���� ��������� ���������� $td ��������� ��������
      // ������ 3, ������������� ������ ���������, � ����������
      // ������� ����������� ��� </tr>, � �������� �����
      // ���������� ��������
      if ($td == 3)
      {
        echo "</tr>";
        $td = 0;
      }         
    }
  }
?>
  </table><br><br>