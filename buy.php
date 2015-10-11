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

  include ('bd.php');
	$strSQL = "SELECT * FROM tovar WHERE id=$_GET[id]";
	$rs = mysql_query($strSQL);
  $id = mysql_fetch_array($rs);
  $id[details] = preg_replace("/\n/", "<br />", $id[details]);
?>
<table cellpadding="0" cellspacing="0" border="0" class="card">
  <!-- Powered by http://ok-lab.enomo.info -->
  <!-- КОММЕНТАРИИ НИ В КОИМ СЛУЧАЕ НЕ УБИРАТЬ - ИСПОЛЬЗУЮТСЯ СКРИПТОМ КАК МЕТКИ!!! -->
  <!-- begin shablon -->
  <tbody><tr class="cardFirst">
    <td class="cardTitle">Название товара:</td>
    <td class="cardDesc"><?php echo$id[name];?></td>
  </tr>
  <!-- end shablon --><!-- begin shablon -->
  <tr>
    <td class="cardTitle">Цена:</td>
    <td class="cardDesc"><span class="srch_cost"><font class="i_price"><?php echo$id[cost];?> руб.</font></span></td>
  </tr>
  <!-- end shablon --><!-- begin shablon -->
  <tr>
    <td class="cardTitle">Изображения:</td>
    <td class="cardDesc">
      <?php
      if (!empty($id[img])){
      echo "<img src='img_tovar/$id[img]' style='height:128px;width:128px;'>";
      }
      if(!empty($id[img2])){
      echo "<img src='img_tovar/$id[img2]' style='height:128px;width:128px;'>";
      }
      if (!empty($id[img3])){
      echo "<img src='img_tovar/$id[img3]' style='height:128px;width:128px;'>";
      }
       ?>
    </td>
		<!-- <a href="http://www.digiseller.ru/preview/466415/p1_41028021156517.JPG" target="blank" alt="Увеличить"><img src="http://www.digiseller.ru/preview/466415/p2_41028021156517.JPG" width="150" height="150" border="0"></a><br><br> -->
  </tr>
  <!-- end shablon --><!-- begin shablon -->
<!--
<tr>
    <td class="cardTitle">Товар:</td>
    <td class="cardDesc">текстовая информация (53 байт)</td>
  </tr>
-->
  <!-- end shablon --><!-- begin shablon -->

  <tr>
    <td class="cardTitle">Описание:</td>
    <td class="cardDesc"><?php echo $id[details] ?></td>
  </tr>
  <!-- end shablon --><!-- begin shablon -->
  <tr>
    <td class="cardTitle">Дополнительная информация:</td>
    <td class="cardDesc"><div rel="nofollow"><noindex>
Инструкция<br>
<b style="color:orange">1</b>. Переходим по этой ссылке <a rel="nofollow" href="https://account.sonyentertainmentnetwork.com/login.action">https://account.sonyentertainmentnetwork.com/login.action</a><br>
<b style="color:orange">2</b>. Вводим адрес электронной почты и пароль купленного аккаунта в PSN и нажимаем кнопку [<b>Войти в сеть</b>].<br>
<b style="color:orange">3</b>. Открываем раздел [<b>Учётная запись</b>]. В столбце слева выбираем пункт [<b>Медиа и устройства</b>]. На основной части страницы нажимаем на прямоугольник [<b>Игра</b>], а затем на кнопку [Деактивировать всё].<br>
<br>
<b style="color:red">Внимание!</b> Все дальнейшие действия строго со своей консоли.<br>
<b style="color:orange">4</b>. В меню [<b>Пользователи</b>] создайте нового пользователя и выполните вход как новый пользователь.<br>
<b style="color:orange">5</b>. В разделе [<b>PlayStation®Network</b>] выберите пункт [<b>Зарегистрироваться</b>].<br>
<b style="color:orange">6</b>. В открывшемся меню выберите [<b>Использовать существующую учетную запись</b>] - именно её, не перепутайте!<br>
<b style="color:orange">7</b>. Далее введите логин (пример:ps@gmail.com) и password (пример: 777psn) от купленного Вами аккаунта и заходим в систему, активируя учетную запись, как основную.<br>
<b style="color:orange">8</b>. После завершения назначения учетной записи появится меню [<b>Войти в сеть</b>] и пользователь сможет войти в сеть PlayStation®Network, используя существующую учетную запись.<br>
<b style="color:orange">9</b>. Войдите в Playstation Store и выберите опцию [<b>Просмотр загружаемых файлов</b>], откроется список контента находящегося на аккаунте, скачайте все что вас интересует в фоновом режиме (ждать полной закачки не нужно).<br>
<br>
<b style="color:red">Внимание!</b> - После загрузки игр - не заходите на купленный аккаунт, а так же не удаляйте пользователя!<br>
<b style="color:orange">10</b>. Заходите на свой основной аккаунт и после завершения всех загрузок можете смело играть. <br>
<br>
<b style="color:red">Гарантии</b><br>
<br>
 Претензии принимаются продавцом в течении 48 часов после оплаты товара,
 для обратной связи используйте пишите в <br><b>скайп: idris0701</b></noindex></div></td>
  </tr>
  <!-- end shablon --><!-- begin shablon -->
  <tr>
    <td class="cardTitle">Статистика:</td>
    <td class="cardDesc"><div rel="nofollow"><strong style="color:red;">В Разработке</strong></div></td>
  </tr>
  <!-- end shablon --><!-- begin shablon -->
	</tbody></table>
<?php
  echo "
  <p>
   <center><button onclick=buy_2() type='button' class='btn' name='button'>Купить</button></center>
  </p>
  <script type='text/javascript'>
    var id = '$_GET[id]';
    var name = '$id[name]';
    var cost = '$id[cost]';
    var buy_login = '$_SESSION[login]';
  </script>
  ";
?>

<?}

// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);

?>
<script src="ajax.js" type="text/javascript">
</script>
