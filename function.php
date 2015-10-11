<?php
  function tovar (){
        $strSQL = "SELECT * FROM tovar";
        $rs = mysql_query($strSQL);
    echo "Мои товары
      <table width=100%><tbody font-size=55px>
        <tr class=room_1>
          <td>id</td>
          <td>Название товара</td>
          <td>Цена</td>
          <td>В наличии</td>
          <td>Удалить</td></tr>";
    while($row = mysql_fetch_array($rs)){
      if($row[4]==$_SESSION[login]){
        // кол-во товаров в наличии
        $res = mysql_query("SELECT COUNT(*) FROM tovar_num WHERE id_tovar=$row[id]");
        $row_num = mysql_fetch_row($res);
        $num_tovar = $row_num[0];
    echo "<tr class=room_2>
            <td>$row[0]</td>
            <td><a href=tovar.php?id=$row[0]>$row[1]</a></td>
            <td>$row[2]</td>
            <td><a href=tovar.php?id=$row[0]&action=tovar>$num_tovar</a></td>
            <td><a href=tovar.php?action=delete&id=$row[0]>Удалить</a></td></tr>";}}
    echo "</table>
      <div id=button>
        <form action='#' method=POST>
          <input type=submit value=Добавить name=add class=add>
          <input type=hidden value=add name=action>
        <form>
      </div>";
  }
  function tovar_add(){
    echo "<form action='#' method=post> Название:			<input name=add_name><br><br> Цена:				<input name=add_cost><br><br> Описание:			<input name=add_details><br><br> <input type=hidden value=tovar_add name=action> <input type=hidden value=$_SESSION[login] name=login> <input type=submit name=add_submit value=Добавить> <a href=tovar.php>Назад</a><br><br> </form>";}
  function tovar_id(){
      $strSQL = "SELECT * FROM tovar WHERE id=$_GET[id]";
      $rs = mysql_query($strSQL);
      $id = mysql_fetch_array($rs);
      echo "
      <table>
        <form action=tovar.php method=GET>
          <tr><input type=hidden name=id value=$_GET[id]>
            <td><button>Описание</button></td>
            <td><button name=action value=tovar>Товар</button></td>
            <td><button name=action value=image>картинки</button></td>
            <td><a href=tovar.php?id=4&action=image>картинки</a></td>
          </tr>
        </form>
      </table>";
    if (!isset($_GET[action])){
      echo "
        <form action='tovar.php?id=$_GET[id]' method=POST>
          Имя:<br>
          <input name=name value='$id[name]'><br><br>
          Цена:<br>
          <input name=cost value=$id[cost]><br><br>
          Описание:<br>
          <textarea name='details' cols='80' rows='12'>$id[details]</textarea><br><br>
          <input type=submit value=Сохранить>
          <input type=hidden name=action value=save_details>
        </form>";}
    if ($_GET[action]==tovar){
      $strSQL = "SELECT * FROM tovar_num WHERE id_tovar=$_GET[id]";
      $rs = mysql_query($strSQL);
      $i=0;
      while($row=mysql_fetch_array($rs)){
        $i++;
        $num[$i]=$row[value];
        $num_id[$i]=$row[id];
      }
      if ($_GET[pn]>$i){$_GET[pn]=$i;}
      if ($_GET[pn]=='new'){$_GET[pn]=$i;}
      if (!isset($_GET[pn]) && $i>0) {$_GET[pn] = 1;}
      $add_style = "page_good_new";
      if ($_GET[pn]==add || $i==0){
        $_GET[pn]=add;
        $add_style = "page_good_select";}
      $val = $_GET[pn];
      echo "
        <form method=GET>
          <input type=hidden name=id value=$_GET[id]>
          <input type=hidden name=action value=tovar>
          <input type=hidden name=add value=$num_id[$val]>
          <input type=hidden name=pn value=$_GET[pn]>
          <textarea name='value' cols='80' rows='12'>$num[$val]</textarea><br><br>
          <input type=submit name=id_save value=Сохранить>
          <a href=tovar.php?action=tovar&add=true&id=$_GET[id]&pn=$_GET[pn]&id_delete=$num_id[$val]><input type='button' name='delete_num' value='Удалить'></a>
        </form>
          <table width='100%' cellpadding='0' cellspacing='0' border='0'><tbody>
            <tr><td width='100%' valign='top' align='left'>";
      while ($a < $i) {
        $a++;
        if ($_GET[pn]==$a){echo "<div class='page_good_select'>$a</div>";}
        else { echo "<div onfocus='this.blur()' onclick='window.location='?typeview=free&amp;id_d=1816695&amp;id_g=20335917&amp;pn=2';'
        class='page_good'><a href='?id=$_GET[id]&action=tovar&pn=$a' class='link_small'>$a</a></div>";}
      }
      echo "<div class='$add_style'><a href=?id=$_GET[id]&action=tovar&pn=add>Добавить</a></div></td></tr></tbody></table>";
    }
    if ($_GET[action]==image){
      $sql = mysql_query("SELECT * FROM tovar WHERE id=$_GET[id]");
      $sql_arr = mysql_fetch_array($sql);
      echo "<table><tr>";
      if (!empty($sql_arr[img])){
        echo "<td>
                <div id='img'><img width=64px src='img_tovar/$sql_arr[img]'><br>
                <a onclick=del('img',$_GET[id]) style='cursor:pointer'>Удалить</a></div>
              </td>";
      }
      if (!empty($sql_arr[img2])){
        echo "<td>
                <div id='img2'><img width=64px src='img_tovar/$sql_arr[img2]'><br>
                <a onclick=del('img2',$_GET[id]) style='cursor:pointer'>Удалить</a></div>
              </td>";
      }
      if (!empty($sql_arr[img3])){
        echo "<td>
                <div id='img3'><img width=64px src='img_tovar/$sql_arr[img3]'><br>
                <a onclick=del('img3',$_GET[id]) style='cursor:pointer'>Удалить</a></div>
              </td>";
      }
      echo "</tr></table>";
      echo " <form enctype='multipart/form-data' method='POST'>
      <input name='send_file' type=file accept='image/*'>
      <input type=submit>
      </form>
      ";
    }

  }
?>
