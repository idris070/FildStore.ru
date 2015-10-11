<?php
function tmp_open($type,$tmp_dir,$file,$head){
if(!isset($type) or empty($type) or !isset($tmp_dir) or empty($tmp_dir) or !isset($file) or empty($file)){
echo "Не заданы параметры шаблона!<br />\r\n";}
else{
  if(!@file_exists($tmp_dir.$file)){
  echo "Файл шаблона не может быть найден. Укажите корректный путь! <br />\r\n<!--".$tmp_dir.$file."-->";}
  else{
    switch($type){
      case "php": require_once $tmp_dir.$file;
      break; 
      default: echo "Указанный тип шаблонизации не найден!<br />\r\n";
      break;}}}}
?>