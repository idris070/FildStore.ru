<?php
  ////////////////////////////////////////////////////////////
  // Блок "Фотогалерея"
  // 2004-2007 (C) IT-студия SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE);
  // Осуществляем соединение с базой данных
  require_once("../config.php");
  // Формируем и выполняем SQL-запрос на сокрытие каталога
  $query = "UPDATE photo SET hide='hide' 
            WHERE id_photo=".$_GET['id_photo'];
  if(mysql_query($query))
  {
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?id_parent=".$_GET['id_catalog']."'>
          </HEAD>";
  } else puterror("Ошибка при сокрытии контактной информации");
?>