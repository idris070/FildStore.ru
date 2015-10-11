<?php
// сортировка по типу отзывов(все подряд, положительные, отрицательные)
if(isset($_REQUEST["type_responses"]) and !empty($_REQUEST["type_responses"])){
$_REQUEST["type_responses"] = trim(strip_tags($_REQUEST["type_responses"]));
session_start();
	switch($_REQUEST["type_responses"]){
	case "all":
	$_SESSION["type_responses"] = "all";
	break;

	case "good":
	$_SESSION["type_responses"] = "good";
	break;
	
	case "bad":
	$_SESSION["type_responses"] = "bad";
	break;
	
	default:
	$_SESSION["type_responses"] = "all";}}
else{
	switch($responses["default_type"]){
	case "all":
	$GLOBALS["type_responses"] = "all";
	break;

	case "good":
	$GLOBALS["type_responses"] = "good";
	break;
	
	case "bad":
	$GLOBALS["type_responses"] = "bad";
	break;
	
	default:
	$GLOBALS["type_responses"] = "all";}}
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>