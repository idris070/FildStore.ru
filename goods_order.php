<?php
// сортировка товаров по имени, по цене
if(isset($_REQUEST["order"]) and !empty($_REQUEST["order"])){
$_REQUEST["order"] = trim(strip_tags($_REQUEST["order"]));
session_start();
	switch($_REQUEST["order"]){
	case "name":
	$_SESSION["order"] = "name";
	break;
	
	case "nameDESC":
	$_SESSION["order"] = "nameDESC";
	break;
	
	case "price":
	$_SESSION["order"] = "price";
	break;
	
	case "priceDESC":
	$_SESSION["order"] = "priceDESC";
	break;
	
	default:
	$_SESSION["order"] = "name";}}
else{
	switch($GLOBALS["order"]){
	case "name":
	$GLOBALS["order"] = "name";
	break;

	case "nameDESC":
	$GLOBALS["order"] = "nameDESC";
	break;
	
	case "price":
	$GLOBALS["order"] = "price";
	break;
	
	case "priceDESC":
	$GLOBALS["order"] = "priceDESC";
	break;
	
	default:
	$GLOBALS["order"] = "name";}}
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>