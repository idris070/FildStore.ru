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

// заголовок страницы, ID продавца и пр. параметры
$head["title"] = "Агентская программа - ссылка";
$GLOBALS["seller_id"] = $seller_id;
$GLOBALS["mess"] = $_mess;
$GLOBALS["default_rt"] = $default_rt;
$GLOBALS["tmp_dir"] = $tmp_dir;

// функция вывода контента
function show_content() {
?>
<div id="main_data">
<h3 class="agent">Агентская ссылка</h3>
<?php
// если ID агента не установлен
if(empty($_COOKIE["ai"]) or $_COOKIE["ai"] <= 0) {

$obj = new core;

if(!isset($_REQUEST["ae"]) or !isset($_REQUEST["ch_code"])) {
if(!empty($_SERVER["HTTP_REFERER"])) {
$_SESSION["h_r"] = $_SERVER["HTTP_REFERER"]; }

$answer_agent_req_num = $obj -> parse_xml($obj -> agent_req_num($GLOBALS["seller_id"]));

if($answer_agent_req_num -> retval != 0) {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; }
else {
echo "<form action=\"\" method=\"post\">
<p>Email:<br />
<input type=\"text\" name=\"ae\" /></p>
<p>Проверочный код:<br />
<input type=\"text\" name=\"ch_code\" maxlength=\"4\" onkeypress=\"if((event.keyCode < 48)||(event.keyCode > 57)) event.returnValue=false\" /></p>
<div id=\"ch_code\">
<img src=\"".$answer_agent_req_num -> img_url."\" id=\"captcha\" onclick=\"reloadImage(this);\" />
<a href=\"#\" onclick=\"reloadImage(document.getElementById('captcha')); return false;\">Обновить картинку</a>
</div>
<input type=\"hidden\" name=\"id_req\" value=\"".$answer_agent_req_num -> id_request."\" />
<input type=\"submit\" value=\"Получить ссылку\" />
</form>
<p>Подробнее про агентскую программу можно прочесть на соответствующей <a href=\"agent.php\" title=\"агентская программа\">странице</a>.</p>\r\n"; } }
else {
$_REQUEST["ae"] = trim($_REQUEST["ae"]);
$_REQUEST["ch_code"] = preg_replace("/[^0-9]/", "", $_REQUEST["ch_code"]);
$_REQUEST["id_req"] = preg_replace("/[^0-9]/", "", $_REQUEST["id_req"]);

if(empty($_REQUEST["ae"]) or !preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim($_REQUEST["ae"])) or empty($_REQUEST["ch_code"]) or strlen($_REQUEST["ch_code"]) < 4) {
$answer_agent_req_num = $obj -> parse_xml($obj -> agent_req_num($GLOBALS["seller_id"]));

if(!isset($_REQUEST["id_req"]) or $_REQUEST["id_req"] <= 0) {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; }
else {

$form = "<form action=\"\" method=\"post\">
<p>Email:<br />";

if(empty($_REQUEST["ae"]) or !preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim($_REQUEST["ae"]))) {
$form .= "<input type=\"text\" name=\"ae\" style=\"border:1px solid #ff0000;\" /></p>
<p>Проверочный код:<br />"; }
else {$form .= "<input type=\"text\" name=\"ae\" value=\"".$_REQUEST["ae"]."\" /></p>
<p>Проверочный код:<br />";}

if(empty($_REQUEST["ch_code"]) or strlen($_REQUEST["ch_code"]) < 4) {
$form .= "<input type=\"text\" name=\"ch_code\" maxlength=\"4\" onkeypress=\"if((event.keyCode < 48)||(event.keyCode > 57)) event.returnValue=false\" style=\"border:1px solid red;\" /></p>
<div id=\"ch_code\">
<img src=\"".$answer_agent_req_num -> img_url."\" id=\"captcha\" onclick=\"reloadImage(this);\" />
<a href=\"#\" onclick=\"reloadImage(document.getElementById('captcha')); return false;\">Обновить картинку</a>
</div>
<input type=\"hidden\" name=\"id_req\" value=\"".$_REQUEST["id_req"]."\" />
<input type=\"submit\" value=\"Получить ссылку\" />
</form>\r\n"; }
else {
$form .= "<input type=\"text\" name=\"ch_code\" maxlength=\"4\" onkeypress=\"if((event.keyCode < 48)||(event.keyCode > 57)) event.returnValue=false\" /></p>
<div id=\"ch_code\">
<img src=\"".$answer_agent_req_num -> img_url."\" id=\"captcha\" onclick=\"reloadImage(this);\" />
<a href=\"#\" onclick=\"reloadImage(document.getElementById('captcha')); return false;\">Обновить картинку</a>
</div>
<input type=\"hidden\" name=\"id_req\" value=\"".$_REQUEST["id_req"]."\" />
<input type=\"submit\" value=\"Получить ссылку\" />
</form>\r\n"; }
echo $form."<p>Подробнее про агентскую программу можно прочесть на соответствующей <a href=\"agent.php\" title=\"агентская программа\">странице</a>.</p>\r\n"; } }
else {
if(!empty($_SESSION["h_r"])) {
$redirect_url = $_SESSION["h_r"]; }
else {$redirect_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];}

$answer_agent_check = $obj -> agent_check($GLOBALS["seller_id"], $_REQUEST["id_req"], $_REQUEST["ch_code"], $_REQUEST["ae"], $redirect_url);
$answer_agent_check = $obj -> parse_xml($answer_agent_check);

if($answer_agent_check -> retval == "-1" or $answer_agent_check -> retval == "-2" or $answer_agent_check -> retval == "-3" or $answer_agent_check -> retval == "-4" or $answer_agent_check -> retval == "-5") {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; }
elseif($answer_agent_check -> retval == 4) {
echo "<p>Вы допустили ошибку при вводе проверочного кода, можете <a href=\"".$redirect_url."\">повторить попытку</a> снова.</p>\r\n"; }
elseif($answer_agent_check -> retval == 0) {
if($answer_agent_check -> id_agent > 0) {
setcookie ("ai", $answer_agent_check -> id_agent, time()+31536000);

if(!empty($_REQUEST["id_goods"])) {
$_REQUEST["id_goods"] = preg_replace("/[^0-9]/", "", $_REQUEST["id_goods"]); }

if(!empty($_REQUEST["id_goods"])) {
show_name_rate();

$obj = new core;
$answer = $obj -> parse_xml($obj -> goods_info($_REQUEST["id_goods"], $GLOBALS["currency"]));

if($answer -> retval != 0) {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; }
else {
echo "<p>Внешний вид кнопки:</p>
<div style=\"width:400px; padding:10px; border:1px solid #000000;\">
<span style=\"color:#cc6600;\">".$answer -> name_goods."</span><br /><br />\r\n";

if(!empty($answer -> price_goods -> $GLOBALS["currency"])) {
echo "Цена: <span style=\"color:green; font-weight:bold;\">".$answer -> price_goods -> $GLOBALS["currency"].$GLOBALS["curr_name"]."</span>\r\n"; }

echo "<p style=\"text-align:center;\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$answer_agent_check -> id_agent."\"><img src=\"http://www.digiseller.ru/outside/images/pay_get.gif\" border=\"0\" alt=\"Оплатить и получить\" title=\"Оплатить и получить\" /></a><br />
<span style=\"text-align:center; font-size:x-small; color:red;\">моментальное получение товара после оплаты</span></p>
</div>\r\n"; }

if(!empty($answer -> reward) && $answer -> reward > 0) {
echo "<p>Агентское вознаграждение при продаже данного товара:<span class=\"success\">".$answer -> reward_summ.$GLOBALS["curr_name"]."</span><p>\r\n"; }

echo "<p><strong>HTML-код кнопки &laquo;Оплатить и получить&raquo;</strong>:</p>
<textarea class=\"agent_url\"><div style=\"width:400px; padding:10px; border:1px solid #000000;\">
<span style=\"color:#cc6600;\">".$answer -> name_goods."</span><br /><br />\r\n";

if(!empty($answer -> price_goods -> $GLOBALS["currency"])) {
echo "Цена: <span style=\"color:green; font-weight:bold;\">".$answer -> price_goods -> $GLOBALS["currency"].$GLOBALS["curr_name"]."</span>\r\n"; }

echo "<p style=\"text-align:center;\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$answer_agent_check -> id_agent."\"><img src=\"http://www.digiseller.ru/outside/images/pay_get.gif\" border=\"0\" alt=\"Оплатить и получить\" title=\"Оплатить и получить\" /></a><br />
<span style=\"text-align:center; font-size:x-small; color:red;\">моментальное получение товара после оплаты</span></p>
</div></textarea>
<p><strong>Ссылка на страницу описания товара</strong>:</p>\r\n";

$url_agent = dirname("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])."/goods_info.php?id=".$answer -> id_goods."&ai=".$answer_agent_check -> id_agent;

echo "<textarea class=\"agent_url\">".$url_agent."</textarea>
<p><strong>Ссылка на страницу оплаты товара</strong>:</p>
<textarea class=\"agent_url\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$answer_agent_check -> id_agent."\">".$answer -> name_goods."</a>(<strong>".$answer -> price_goods -> $GLOBALS["currency"]."</strong>".$GLOBALS["curr_name"].")</textarea>\r\n";

if(strpos($redirect_url, "?")) {
$redirect_url = $redirect_url."&ai=".$answer_agent_check -> id_agent; }
else {
$redirect_url = $redirect_url."?ai=".$answer_agent_check -> id_agent; }
echo "<p>Вы можете отправить эту ссыпку друзьям по Email, ICQ или опубликовать на форуме, в блоге или социальной сети. Со всех покупок совершенных вашими друзьями, на ваш <a href=\"https://my.digiseller.ru/inside/ad.asp\">личный счет</a> вы будете получать комиссионные.</p>
<p><strong>Добавить партнерскую ссылку в</strong><br /><br />
<a href=\"http://vkontakte.ru/share.php?url=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/vkontakte.jpg\" /></a>
<a href=\"http://my.ya.ru/posts_share_link.xml?url=".$redirect_url."&title=&body=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/yandex.jpg\" /></a>
<a href=\"http://www.facebook.com/sharer.php?u=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/facebook.jpg\" /></a>
<a href=\"http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/odnoklassniki.jpg\" /></a>
<a href=\"http://connect.mail.ru/share?url=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/moj_mir.jpg\" /></a>
<a href=\"https://plus.google.com/share?url=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/google+.jpg\" /></a>
<a href=\"https://twitter.com/intent/tweet?original_referer=http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&source=tweetbutton&text=&url=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/twitter.jpg\" /></a>
<a href=\"http://moikrug.ru/share?url=".$redirect_url."&title=&description=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/moj_krug.jpg\" /></a>
<a href=\"http://www.livejournal.com/update.bml?event=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/livejournal.jpg\" /></a>
<a href=\"http://pinterest.com/pin/create/button/?url=".$redirect_url."&media=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/pinterest.jpg\" /></a>
<a href=\"http://friendfeed.com/?url=".$redirect_url."&title=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/friendfeed.jpg\" /></a>
<a href=\"http://surfingbird.ru/share?url=".$redirect_url."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/surfingbird.jpg\" /></a></p>\r\n"; }
else {
if(!empty($_SESSION["ai"]) && $_SESSION["ai"] > 0) {
echo "<p><strong>Ваша агентская ссылка</strong>:</p>
<textarea class=\"agent_url\">".dirname("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])."/index.php?ai=".$_SESSION["ai"]."</textarea>\r\n"; }
else {
echo "<meta http-equiv=\"refresh\" content=\"0; url=agent_url.php\" />\r\n"; } } }
else {
echo "<p><span class=\"success\">Регистрация вас в качестве агента успешно пройдена!</span><br />На указанный email отправлено сообщение с кодом подтверждения.</p>\r\n";  } }
else {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; } } } }

// если ID агента установлен
else {
if(!empty($_SERVER["HTTP_REFERER"])) {
$url = $_SERVER["HTTP_REFERER"]; }
else {$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];}

if(!empty($_REQUEST["id_goods"])) {
$_REQUEST["id_goods"] = preg_replace("/[^0-9]/", "", $_REQUEST["id_goods"]); }

if(!empty($_REQUEST["id_goods"])) {
show_name_rate();

$obj = new core;
$answer = $obj -> parse_xml($obj -> goods_info($_REQUEST["id_goods"], $GLOBALS["currency"]));

if($answer -> retval != 0) {
echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n"; }
else {
echo "<p>Внешний вид кнопки:</p>
<div style=\"width:400px; padding:10px; border:1px solid #000000;\">
<span style=\"color:#cc6600;\">".$answer -> name_goods."</span><br /><br />\r\n";

if(!empty($answer -> price_goods -> $GLOBALS["currency"])) {
echo "Цена: <span style=\"color:green; font-weight:bold;\">".$answer -> price_goods -> $GLOBALS["currency"].$GLOBALS["curr_name"]."</span>\r\n"; }

echo "<p style=\"text-align:center;\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$_COOKIE["ai"]."\"><img src=\"http://www.digiseller.ru/outside/images/pay_get.gif\" border=\"0\" alt=\"Оплатить и получить\" title=\"Оплатить и получить\" /></a><br />
<span style=\"text-align:center; font-size:x-small; color:red;\">моментальное получение товара после оплаты</span></p>
</div>\r\n"; }

if(!empty($answer -> reward) && $answer -> reward > 0) {
echo "<p>Агентское вознаграждение при продаже данного товара:<span class=\"success\">".$answer -> reward_summ.$GLOBALS["curr_name"]."</span><p>\r\n"; }

echo "<p><strong>HTML-код кнопки &laquo;Оплатить и получить&raquo;</strong>:</p>
<textarea class=\"agent_url\"><div style=\"width:400px; padding:10px; border:1px solid #000000;\">
<span style=\"color:#cc6600;\">".$answer -> name_goods."</span><br /><br />\r\n";

if(!empty($answer -> price_goods -> $GLOBALS["currency"])) {
echo "Цена: <span style=\"color:green; font-weight:bold;\">".$answer -> price_goods -> $GLOBALS["currency"].$GLOBALS["curr_name"]."</span>\r\n"; }

echo "<p style=\"text-align:center;\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$_COOKIE["ai"]."\"><img src=\"http://www.digiseller.ru/outside/images/pay_get.gif\" border=\"0\" alt=\"Оплатить и получить\" title=\"Оплатить и получить\" /></a><br />
<span style=\"text-align:center; font-size:x-small; color:red;\">моментальное получение товара после оплаты</span></p>
</div></textarea>
<p><strong>Ссылка на страницу описания товара</strong>:</p>\r\n";

$url_agent = dirname("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])."/goods_info.php?id=".$answer -> id_goods."&ai=".$_COOKIE["ai"];

echo "<textarea class=\"agent_url\">".$url_agent."</textarea>
<p><strong>Ссылка на страницу оплаты товара</strong>:</p>
<textarea class=\"agent_url\"><a href=\"http://www.oplata.info/asp/pay_wm.asp?id_d=".$answer -> id_goods."&ai=".$_COOKIE["ai"]."\">".$answer -> name_goods."</a>(<strong>".$answer -> price_goods -> $GLOBALS["currency"]."</strong>".$GLOBALS["curr_name"].")</textarea>

<p>Вы можете отправить эту ссыпку друзьям по Email, ICQ или опубликовать на форуме, в блоге или социальной сети. Со всех покупок совершенных вашими друзьями, на ваш <a href=\"https://my.digiseller.ru/inside/ad.asp\">личный счет</a> вы будете получать комиссионные.</p>
<p><strong>Добавить партнерскую ссылку в</strong><br /><br />
<a href=\"http://vkontakte.ru/share.php?url=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/vkontakte.jpg\" /></a>
<a href=\"http://my.ya.ru/posts_share_link.xml?url=".$url_agent."&title=&body=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/yandex.jpg\" /></a>
<a href=\"http://www.facebook.com/sharer.php?u=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/facebook.jpg\" /></a>
<a href=\"http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/odnoklassniki.jpg\" /></a>
<a href=\"http://connect.mail.ru/share?url=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/moj_mir.jpg\" /></a>
<a href=\"https://plus.google.com/share?url=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/google+.jpg\" /></a>
<a href=\"https://twitter.com/intent/tweet?original_referer=http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&source=tweetbutton&text=&url=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/twitter.jpg\" /></a>
<a href=\"http://moikrug.ru/share?url=".$url_agent."&title=&description=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/moj_krug.jpg\" /></a>
<a href=\"http://www.livejournal.com/update.bml?event=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/livejournal.jpg\" /></a>
<a href=\"http://pinterest.com/pin/create/button/?url=".$url_agent."&media=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/pinterest.jpg\" /></a>
<a href=\"http://friendfeed.com/?url=".$url_agent."&title=\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/friendfeed.jpg\" /></a>
<a href=\"http://surfingbird.ru/share?url=".$url_agent."\"><img src=\"".$GLOBALS["tmp_dir"]."/i/soc_share/surfingbird.jpg\" /></a></p>\r\n"; }
else {
echo "<p><strong>Ваша агентская ссылка</strong>:</p>
<textarea class=\"agent_url\">".dirname("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])."/index.php?ai=".$_COOKIE["ai"]."</textarea>\r\n"; } }
?>
</div>
<?php }
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);
?>
