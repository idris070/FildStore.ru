<?php
// сортировка товаров по имени, по цене
if(isset($_REQUEST["goods_count"]) and !empty($_REQUEST["goods_count"])){
$_REQUEST["goods_count"] = trim(strip_tags($_REQUEST["goods_count"]));
session_start();
	switch($_REQUEST["goods_count"]){
	case 10:
	$_SESSION["goods_count"] = 10;
	break;

	case 20:
	$_SESSION["goods_count"] = 20;
	break;

	case 50:
	$_SESSION["goods_count"] = 50;
	break;

	case 100:
	$_SESSION["goods_count"] = 100;
	break;

	default:
	$_SESSION["goods_count"] = 10;}}
else{
	switch($GLOBALS["goods_count"]){
	case 10:
	$GLOBALS["goods_count"] = 10;
	break;

	case 20:
	$GLOBALS["goods_count"] = 20;
	break;

	case 50:
	$GLOBALS["goods_count"] = 50;
	break;

	case 100:
	$GLOBALS["goods_count"] = 100;
	break;

	default:
	$GLOBALS["goods_count"] = 100;}}
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>
