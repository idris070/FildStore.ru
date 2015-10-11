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
include 'bd.php';
if (isset($_POST[id])){
    $sql = mysql_query ("SELECT * FROM `tovar` WHERE id=$_POST[id]");
    $sql = mysql_fetch_array($sql);
      $cost = $sql[cost];
      $seller = $sql[login];
      $name = $sql[name];
        $sql = mysql_query ("SELECT * FROM `tovar_num` WHERE id_tovar=$_POST[id] LIMIT 1");
          while ($rslt = mysql_fetch_assoc($sql)){
          $tovar_id=$rslt[id];
          $tovar_value=$rslt[value];
      }
          mysql_query ("INSERT INTO buy_history (`name`,`seller`, `key`, `buy_login`, `data`) VALUES ('$name','$seller','$tovar_value','$_POST[buy_login]','$_POST[LMI_SYS_TRANS_DATE]')");
          mysql_query ("DELETE FROM `tovar_num` WHERE id=$tovar_id");
  }
?>


<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
