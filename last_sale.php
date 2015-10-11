<?php
require_once "./config.php";
require_once $inc_path."functions.php";

$obj = new core;
$answer = @$obj -> parse_xml($obj -> get_last_sale($seller_id));

// если ошибок нет
if($answer && $answer -> retval == 0) {
$date_sale = $answer -> last_sale -> date_sale;
$date_sale = explode(" ", $date_sale);
$lsd = $date_sale[0];
$lst = $date_sale[1];

// определение текущей даты
$now_date = date("d.m.Y");

// анализ даты
if($lsd == $now_date) {
$dec_last_sale = "сегодня(".$lst.")\r\n"; }
else {
$dec_last_sale = $lsd."(".$lst.")\r\n"; }

echo "Последняя продажа <span class=\"success\">".$dec_last_sale."</span> <a href=\"goods_info.php?id=".$answer -> last_sale -> id_goods."\">".$answer -> last_sale -> name_goods."</a>\r\n"; }
?>