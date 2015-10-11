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
$head["title"] = "Профиль";

// функция вывода контента
function show_content() {
?>
<center><b>Личные данные</b></center><br>
<table id="profile">
  <form action="profile.php" method="post">
    <tr>
      <td><div class="profile_left">Логин:</div></td>
      <td><div class="profile_right"><b>idris070</b></div></td>
    </tr>
    <tr>
      <td><div class="profile_left">Пароль:</div></td>
      <td><div class="profile_right"><input type="text" name="password" value=""></div></td>
    <tr>
    </tr>
      <td><div class="profile_left">Email:</div></td>
      <td><div class="profile_right"><b>idris_kurbanov@mail.ru</b></div></td>
    </tr>
  </tr>
    <td><div class="profile_left">skype:</div></td>
    <td><div class="profile_right"><b>idris0701</b></div></td>
  </tr>
</tr>
  <td><div class="profile_left">vk</div></td>
  <td><div class="profile_right"><b>www.vk.com/idris070</b></div></td>
</tr>
  </form>
</table>

<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
