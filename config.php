<?php
// настройки шаблона
$inc_path = "./inc/";
$tmp_dir = "./templates/0/";

// общие настройки
// id продавца
$seller_id = 342118;
// тип валюты (по умолчанию)
$default_rt = "WMR";

// сортировка товаров (по умолчанию)
$default_order = "name";
// количество строк (по умолчанию)
$default_rows = 15;
// id группы товаров (по умолчанию)
$default_gl = "0";
// URL логотипа
$logo = array($GLOBALS["tmp_dir"]."/img/logo_shop.png",true);
// горизонтальное меню (true - отображать, false - нет)
$hor_menu = true;
// форма поиска (true - отображать, false - нет)
$search_form = true;
// вертикальное меню (true - отображать, false - нет)
$ver_menu = true;
// отображение поисковой формы (true - отображать, false - нет)
$search_status = true;
// отображение верхнего меню (true - отображать, false - нет)
$top_menu_status = true;
// отображение списка категорий (true - отображать, false - нет)
$categories_status = true;

// главная страница
// отображаемая нумерация страниц
$main["pages"] = 5;
// размер изображения категории
$main["category_img_size"] = 130;
// размер изображения товара
$main["goods_img_size"] = 130;

// страница с листингом товаров
// количество товаров на странице
$listing["goods_count"] = 15;
// отображаемая нумерация страниц
$listing["pages"] = 3;
// размер изображения
$listing["img_size"] = 180;

// страница описания товара
// тип отображаемых отзывов
$info_goods["resp_block_dt"] = "all";
// количество строк
$info_goods["resp_block_row"] = 1;
// отображаемая нумерация страниц
$info_goods["resp_block_pages"] = 5;
// размер изображения
$info_goods["img_size"] = 180;

// страница контактов
$contacts["fio"] = "выфвфыв";
$contacts["email"] = "vladimir1711@list.ru";
$contacts["icq"] = "";
$contacts["skype"] = "mydigiseller.ru";
$contacts["phone"] = "+ 7 707 629 28";
$contacts["wmid"] = "456713322776";

// страница отзывов
// тип отображаемых отзывов
$responses["default_type"] = "all";
// отображаемая нумерация страниц
$responses["pages"] = 5;

// параметры поиска
// количество товаров на странице
$search["goods_count"] = 15;
// отображаемая нумерация страниц
$search["count_page"] = 5;
?>
