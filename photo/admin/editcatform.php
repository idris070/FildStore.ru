<?php
  ////////////////////////////////////////////////////////////
  // Блок "Фотогалерея"
  // 2004-2007 (C) IT-студия SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // Устанавливаем соединение с базой данных
  require_once ("../config.php");
  $titlepage = "Редактирование группы контактов";
  $button = "Исправить";
  $action = "editcat.php";
  $query = "SELECT * FROM photocat 
            WHERE id_catalog=".$_GET['id_catalog'];
  $cat = mysql_query($query);
  if ($cat)
  {
    $catalog = mysql_fetch_array($cat);
    $name = $catalog['name'];
    $description = $catalog['description'];
    $pos = $catalog['pos'];
  }
  include "addcatform.php";
?>