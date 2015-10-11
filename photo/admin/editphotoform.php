<?php
  ////////////////////////////////////////////////////////////
  // Блок "Фотогалерея"
  // 2004-2007 (C) IT-студия SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // Устанавливаем соединение с базой данных
  require_once ("../config.php");
  // Настраиваем HTML-форму для исправления позиции с фотографией
  $titlepage = "Редактирование фотографической позиции";
  $button = "Исправить";
  $action = "editphoto.php";
  $id_photo = $_GET['id_photo'];
  // Формируем и выполняем SQL-запрос
  $query = "SELECT * FROM photo 
            WHERE id_photo = $id_photo";
  $pht = mysql_query($query);
  if ($pht)
  {
    $photo = mysql_fetch_array($pht);
    $name = $photo['name'];
    $pos = $photo['pos'];
    if($photo['hide'] == "show") $showhide = "checked";
    else $showhide = "";
    include "addphotoform.php";
  }
?>