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
?>

<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>