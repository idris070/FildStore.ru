<?php
require_once "./config.php";
require_once $inc_path."functions.php";


$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
session_start();
// проверка агентского ID
get_agent_id();

// заголовок страницы
$head["title"] = "Регистрация";

// функция вывода контента
function show_content() {

if (isset($_SESSION[login])){
  include ('bd.php');
  if (isset($_GET[id])){
    $strSQL = "SELECT * FROM buy_history WHERE id=$_GET[id] and buy_login='$_SESSION[login]'";
    $rs = mysql_query($strSQL);
    $rs = mysql_fetch_array($rs);
    echo "
    <div id='buy_history'>
      <div class='b1'>
          <div class='b2_title'><b>Название товара:</b></div>
          <div class='b2_desc'>$rs[name]</div>
      </div>
      <div class='b1'>
          <div class='b2_title'><b>Купленый товар:</b></div>
          <div class='b2_desc'>$rs[key]</div>
      </div>
      <div class='b1'>
          <div class='b2_title'><b>Имя продавца:</b></div>
          <div class='b2_desc'>$rs[seller]</div>
      </div>
      <div class='b1'>
          <div class='b2_title'><b>Дата покупки:</b></div>
          <div class='b2_desc'>$rs[data]</div>
      </div>
    </div>
    ";

  }
  else {
	$strSQL = "SELECT * FROM buy_history WHERE buy_login='$_SESSION[login]'";
	$rs = mysql_query($strSQL);
    echo "Мои Покупки
      <table width=100%>
      <tbody font-size=55px>
      <tr class=room_1 style='text-align:center'>
      <td><div class='b2_desc'>№</div></td>
      <td><div class='b2_desc'>Товар</div></td>
      <td><div class='b2_desc'>Продавец</div></td></tr>";
      while($row = mysql_fetch_array($rs)){
    echo "<tr class=room_2>
      <td><div class='b2_desc'>$row[0]</div></td>
      <td><div class='b2_desc'><a href=buy_history.php?id=$row[0]>$row[name]</a></div></td>
      <td><div class='b2_desc'>$row[seller]</div></td></tr>";}
    echo "</table>";}}
else {
    echo "вам необходимо вначале войти";
  }
?>


<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
