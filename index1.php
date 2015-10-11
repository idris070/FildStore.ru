<?php
require_once "./inc/functions.php";

$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
// заголовок страницы, ID продавца и пр. параметры
$head["title"] = "Мой магазин";
$GLOBALS["default_gl"] = $default_gl;
$GLOBALS["default_order"] = $default_order;
$GLOBALS["tmp_dir"] = $tmp_dir;
$GLOBALS["category_img_size"] = $main["category_img_size"];
$GLOBALS["goods_img_size"] = $main["goods_img_size"];
// установленная страница(по умолчанию - 1)
get_current_page();
// количество строк и количество страниц
$GLOBALS["rows"] = $default_rows;
$GLOBALS["count_page"] = $main["pages"];

// определение типа валюты
show_other_name_rate();
// определиние порядка сортировки
	if(isset($_SESSION["order"]) and !empty($_SESSION["order"])){
		switch($_SESSION["order"]){
			case "name":
			$order = "name";
			break;

			case "nameDESC":
			$order = "nameDESC";
			break;

			case "price":
			$order = "price";
			break;

			case "priceDESC":
			$order = "priceDESC";
			break;

			default:
			$order = "name";}}
	else{
		if(isset($GLOBALS["default_order"]) and !empty($GLOBALS["default_order"])){
			switch($GLOBALS["default_order"]){
				case "name":
				$order = "name";
				break;

				case "nameDESC":
				$order = "nameDESC";
				break;

				case "price":
				$order = "price";
				break;

				case "priceDESC":
				$order = "priceDESC";
				break;

				default:
				$order = "name";}}}
$GLOBALS["order"] = $order;

// функция вывода контента
function show_content(){
	$result = "";

	// определение ID группы товаров
	if(isset($_GET["category_id"]) && !empty($_GET["category_id"])){
	$_GET["category_id"] = abs((int)$_GET["category_id"]);
		if(!empty($_GET["category_id"])){
		$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$_GET["category_id"],$_REQUEST["page"],$GLOBALS["rows"],$GLOBALS["curr_name"],$GLOBALS["order"]));}
		else {$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$GLOBALS["default_gl"],$_REQUEST["page"],$GLOBALS["rows"],$GLOBALS["curr_name"],$GLOBALS["order"]));}}
	else{$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$GLOBALS["default_gl"],$_REQUEST["page"],$GLOBALS["rows"],$GLOBALS["curr_name"],$GLOBALS["order"]));}

	if($answer -> retval != 0){
	$result .= "<p>".$answer -> retdesc."</p>\n";
	echo $answer -> retdesc;}
	else{
		if(isset($answer -> subcategories -> subcategory)){
		$result .= "<div class=\"digiseller-category-blocks\">\n";
			foreach($answer -> subcategories -> subcategory as $subcategory){
				if((int)$subcategory["cnt"] > 0){
				$result .= "<div>
					<a href=\"listing.php?category_id=".$subcategory -> id."\"><img src=\"http://graph.digiseller.ru/img.ashx?idn=1&amp;maxlength=".$GLOBALS["category_img_size"]."\" alt=\"\"></a>
					<a href=\"listing.php?category_id=".$subcategory -> id."\">".$subcategory -> name."<span>&nbsp;(".$subcategory["cnt"].")</span></a>
				</div>\n";}}
				$result .= "</div>
				<div class=\"digiseller-both\"></div>
				<br />\n";}
	$result .= "<!-- Список товаров -->\n<div class=\"digiseller-productList digiseller-homepage\">\n";

		if($answer -> products["cnt"] > 0){
			if($_REQUEST["page"] > $answer -> pages["cnt"]){
			$result .= "<p>".$GLOBALS["mess"]["page_not_found"]."</p>\n";}
			else{
				foreach($answer -> products -> product as $product){
				$img = "<img src=\"http://graph.digiseller.ru/img.ashx?id_d=".$product -> id."&amp;maxlength=".$GLOBALS["goods_img_size"]."\" alt=\"\" />\n";
					switch($product["icon"]){
						case "sale":
						$html_class_name = " digiseller-newproduct";
						$vitrina_icon = "Новинка!";
						break;

						case "new":
						$html_class_name = " digiseller-action";
						$vitrina_icon = "Акция!";
						break;

						case "top":
						$html_class_name = " digiseller-lider";
						$vitrina_icon = "Лидер продаж!";
						break;

						default:
						$html_class_name = "";
						$vitrina_icon = "&nbsp;";}

						$curr_name = $answer -> products -> currency;
						$self_url = urlencode("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);

				$result .= "<div class=\"digiseller-snapshot\">
						<div>
						<span class=\"digiseller-vitrinaicon $html_class_name\">$vitrina_icon</span><br />
						</div>
						<div>
						<a href=\"./goods_info.php?id=".$product -> id."\" title=\"digiseller-productName\">
						$img
						</a>
						</div>
						<div class=\"digiseller-snapprodnamehldr\" style=\"max-width:180px;\">
							<a href=\"./goods_info.php?id=".$product -> id."\" title=\"productName\"><span class=\"digiseller-snapname\">".$product -> name."</span></a>
						</div>
						<div>
							<span class=\"digiseller-snapprice\">".$product -> price."</span>
							<span class=\"digiseller-snapcurrency\">".$curr_name."</span>
							<a href=\"https://www.oplata.info/asp/pay_x20.asp?id_d=".$product -> id."&amp;dsn=limit\" class=\"digiseller-buyButton\">Купить</a>
						</div>
					</div>\n";}}} include 'box.php';
	$result .= "<div class=\"digiseller-both\"></div>\n</div>\n<!-- end.Список товаров -->
	<div id=\"digiseller-loader\" class=\"digiseller-loader\" style=\"display: none;\">Загрузка...</div>\n";
	echo $result;}

?>

<?php }
// функция шаблонизации
tmp_open($tmp_type,$tmp_dir,$tmp_file,$head);
?>
