<?php
  ////////////////////////////////////////////////////////////
  // ���� "�����������"
  // 2004-2007 (C) IT-������ SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // ���������� ������� ��������� ������ (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // ����� ���������� � ������ �������
  $numphoto = 3;
?>
  <table class=bodytable width="100%" border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>     
<?php
  ///////////////////////////////////////////////////
  // ���� "�����������"
  // 2004 (C) IT-������ SoftTime (http://www.softtime.ru)
  // �������� �.�. (simdyanov@softtime.ru)
  // ������� �.�. (softtime@softtime.ru)
  ///////////////////////////////////////////////////
  // �������� �� ���� ������ ����������
  if(!preg_match("|^[\d]+$|",$id_parent) && !empty($id_parent)) exit();
  $query = "SELECT * FROM photo 
            WHERE id_catalog = $id_parent AND
            hide = 'show' 
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
    // ���������� �� 5 ����� � ������
    $td == 0;
    // ������� ��������� �������
    while($par = mysql_fetch_array($prt))
    {
      // ��������� ���������� $image, ������� ��������������� �� �����
      // ������������ �����������, ����������� ������� �� �����������
      if(!empty($par['small']) &&
         $par['small']!="-" &&
         file_exists($par['small']))
      {
	    $size = getimagesize($par['big']);
        $image = "<a href=# onclick=\"show_img('".$par['big']."',".$size[0].",".$size[1]."); return false \" ><img src=".$par['small']." border=0 vspace=3></a>";
      }
      else $small = "���";
      // ���� �������� ��������� ���������� ����� 0
      // ������� ��� ������ ������ ������� <tr>
      if ($td == 0) echo "<tr>";
      // ������� ����������
      echo "<td><table border=0 width=100%><tr align=center>
              <td><p><b>".$par['name']."</b></p></td></tr>
              <tr align=center>
                 <td>$image</td>
            </tr></table></td>";
      // ����������� �������� ��������� ���������� $td
      $td++;
      // ���� ��������� ���������� $td ��������� ��������
      // ������ 5, ������������� ������ ���������, � ����������
      // ������� ����������� ��� </tr>, � �������� �����
      // ���������� ��������
      if ($td == $numphoto)
      {
        echo "</tr>";
        $td = 0;
      }         
    }
  }
?>
  </table><br><br>