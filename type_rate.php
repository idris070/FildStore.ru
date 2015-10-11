<?php
// сортировка по типу валюты(рубли, доллары и пр.)
if(isset($_REQUEST["rt"])){
$_REQUEST["rt"] = trim(strip_tags($_REQUEST["rt"]));
session_start();
	switch($_REQUEST["rt"]){
	case "wmr":
	$_SESSION["rt"] = "wmr";
	break;

	case "wmz":
	$_SESSION["rt"] = "wmz";
	break;
	
	case "wme":
	$_SESSION["rt"] = "wme";
	break;
	
	case "wmu":
	$_SESSION["rt"] = "wmu";
	break;
	
	default:
	$_SESSION["rt"] = "wmr";}}
else{
	switch($GLOBALS["default_rt"]){
	case "wmr":
	$GLOBALS["default_rt"] = "wmr";
	break;

	case "wmz":
	$GLOBALS["default_rt"] = "wmz";
	break;
	
	case "wme":
	$GLOBALS["default_rt"] = "wme";
	break;
	
	case "wmu":
	$GLOBALS["default_rt"] = "wmu";
	break;
	
	default:
	$GLOBALS["default_rt"] = "wmr";}}
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>