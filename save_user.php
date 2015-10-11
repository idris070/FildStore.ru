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

// Проверка на действие регистрации
  if ($_POST[action]==reg){
    include "bd.php";
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}

//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
   $login = stripslashes($login);
   $login = htmlspecialchars($login);
   $password = stripslashes($password);
   $password = htmlspecialchars($password);

//удаляем лишние пробелы
   $login = trim($login);
   $password = trim($password);

// Условия
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$connect);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
// если такого нет, то сохраняем данные
$result2 = mysql_query ("INSERT INTO users (login,password,email) VALUES('$login','$password','$email')");
// Проверяем, есть ли ошибки
if ($result2=='TRUE')
{
echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
}
else {
echo "Ошибка! Вы не зарегистрированы.";
}
}

?>

<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
