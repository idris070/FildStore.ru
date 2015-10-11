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
<center><form action="save_user.php" method="POST">
<input type="hidden" name="action" value="reg">
Ваш Логин: <br>
<input name="login"><br><br>
Ваш Пароль: <br>
<input name="password"><br><br>
Ваш Email Адресс: <br>
<input name="email"><br><br>
<input type="submit" name="submit" class="submit" value="Зарегистрироваться">
</form></center>
<style>
input.submit{
	color: green;
	}
</style>
<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
