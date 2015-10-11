<?php
  // Принимаем POST
  $user = "u196632156_idris";
  $bd_name = "u196632156_store";
  if ($_POST[action]==tovar_add) {
    $connect = mysql_connect('localhost', $user, '464636zop');
    mysql_select_db ($bd_name,$connect);
    mysql_query ("INSERT INTO tovar (name, cost, login, details) VALUES ('$_POST[add_name]', '$_POST[add_cost];', '$_POST[login]', '$_POST[add_details]')");
    header("Location: tovar.php");
    exit();
  }
  if (isset($_FILES["send_file"])){
    $tmp_name = $_FILES["send_file"]["tmp_name"];  // местоположение тмп
    $name = $_FILES["send_file"]["name"];  // имя файла
    $ext = pathinfo($name, PATHINFO_EXTENSION); // Тип файла.
    $connect = mysql_connect('localhost', $user, '464636zop');
    mysql_select_db ($bd_name,$connect);
    $sql = mysql_query("SELECT * FROM tovar WHERE id=$_GET[id]");
    $sql_arr = mysql_fetch_array($sql);
    if (empty($sql_arr[img])){
      mysql_query ("UPDATE tovar SET img='$_GET[id]i1.$ext' WHERE id=$_GET[id]");
      move_uploaded_file($tmp_name,  "img_tovar/$_GET[id]i1.$ext");}
    elseif (empty($sql_arr[img2])) {
      mysql_query ("UPDATE tovar SET img2='$_GET[id]i2.$ext' WHERE id=$_GET[id]");
      move_uploaded_file($tmp_name,  "img_tovar/$_GET[id]i2.$ext");}
    elseif (empty($sql_arr[img3])){
      mysql_query ("UPDATE tovar SET img3='$_GET[id]i3.$ext' WHERE id=$_GET[id]");
      move_uploaded_file($tmp_name,  "img_tovar/$_GET[id]i3.$ext");}
    header("Location: tovar.php?action=image&id=$_GET[id]");
    exit();
  }
  if ($_POST[action]==save_details){
      $connect = mysql_connect('localhost', $user, '464636zop');
      mysql_select_db ($bd_name,$connect);
      mysql_query("UPDATE `tovar` SET name='$_POST[name]',cost=$_POST[cost],details='$_POST[details]' WHERE id=$_GET[id]");
      header("Location: tovar.php?id=$_GET[id]");
      exit();
    }
  if($_GET[action]==delete){
    $connect = mysql_connect('localhost', $user, '464636zop');
    mysql_select_db ($bd_name,$connect);
    mysql_query("DELETE FROM tovar WHERE id=$_GET[id]");
    header("Location: tovar.php");
    exit();
  }
  if (isset($_GET[add])){
      $connect = mysql_connect('localhost', $user, '464636zop');
      mysql_select_db ($bd_name,$connect);
      if ($_GET[pn]==add) {mysql_query ("INSERT INTO tovar_num (id_tovar, value) VALUES ('$_GET[id]', '$_GET[value]') ");}
      if(isset($_GET[id_delete])) {  mysql_query ("DELETE FROM `tovar_num` WHERE id='$_GET[id_delete]'");}
      if(isset($_GET[id_save])) {  mysql_query ("UPDATE `tovar_num` SET value='$_GET[value]' WHERE id='$_GET[add]'");}
      if($_GET[pn]==add){$_GET[pn]='new';}
      header("Location: tovar.php?id=$_GET[id]&action=tovar&pn=$_GET[pn]");
      exit();}

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
$head["title"] = "Товар";

// функция вывода контента
function show_content() {
include ('bd.php');
  $result = mysql_query("SELECT * FROM users WHERE login='$_SESSION[login]'");
  $user = mysql_fetch_array($result);
include 'function.php';
if (!empty($_SESSION[login])){
  if ($user[seller]=="true") {
    if (!$_POST[action] and !$_GET[id]) {
      tovar();
    }
    if ($_POST[action]==add) {
      tovar_add();
    }
    if (isset($_GET[id])) {
      tovar_id();
    }
  }
  else {
    echo "Вы не продавец!";
  }
}
?>
<style media="screen">
td {
  text-align: center;
  padding-bottom: 5px;
  padding-left: 10px;
  }
</style>
<?php }
  // функция шаблонизации
  tmp_open("php", $tmp_dir, $tmp_file, $head);
?>
<script src="ajax.js" type="text/javascript">

</script>