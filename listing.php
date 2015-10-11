<?php
require_once "./inc/functions.php";

$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
// заголовок страницы и пр. параметры
$head["title"] = "Список товаров";
$GLOBALS["order"] = $default_order;
$GLOBALS["default_gl"] = $default_gl;
$GLOBALS["tmp_dir"] = $tmp_dir;
$GLOBALS["img_size"] = $listing["img_size"];
// установленная страница(по умолчанию - 1)
get_current_page();
// количество строк и количество страниц
$GLOBALS["goods_count"] = $listing["goods_count"];
$GLOBALS["count_page"] = $listing["pages"];
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

// определиние количества выводимых товаров
	if(isset($_SESSION["goods_count"]) and !empty($_SESSION["goods_count"])){
		switch($_SESSION["goods_count"]){
			case 10:
			$count = 10;
			break;
		
			case 20:
			$count = 20;
			break;
		
			case 50:
			$count = 50;
			break;
		
			case 100:
			$count = 100;
			break;
		
			default:
			$count = 10;}}
	else{
		if(isset($GLOBALS["goods_count"]) and !empty($GLOBALS["goods_count"])){
			switch($GLOBALS["goods_count"]){
				case 10:
				$count = 10;
				break;
		
				case 20:
				$count = 20;
				break;
		
				case 50:
				$count = 50;
				break;
		
				case 100:
				$count = 100;
				break;
		
				default:
				$count = 10;}}}
$GLOBALS["goods_count"] = $count;

// функция вывода контента
function show_content(){
$result = "";
	// определение ID группы товаров
	if(isset($_GET["category_id"]) && !empty($_GET["category_id"])){
	$_GET["category_id"] = abs((int)$_GET["category_id"]);
		if(!empty($_GET["category_id"])){
		$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$_GET["category_id"],$_REQUEST["page"],$GLOBALS["goods_count"],$GLOBALS["curr_name"],$GLOBALS["order"]));}
		else {$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$GLOBALS["default_gl"],$_REQUEST["page"],$GLOBALS["goods_count"],$GLOBALS["curr_name"],$GLOBALS["order"]));}}
	else{$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_list($GLOBALS["seller_id"],$GLOBALS["default_gl"],$_REQUEST["page"],$GLOBALS["goods_count"],$GLOBALS["curr_name"],$GLOBALS["order"]));}	
	
	if($answer -> retval != 0){
	$result .= "<p>".$answer -> retdesc."</p>\n";
	echo $answer -> retdesc;}
	else{
		$cat = $answer -> categories -> category;
		$result .= get_category_name($cat);
		$result .= "<div class=\"digiseller-breadcrumbs\">
					<a href=\"./\" title=\"Магазин\">Магазин</a>".get_name_categories($cat)."
					</div>\r\n";
				
		if(!empty($answer -> subcategories -> subcategory)){
			$result .= "<div class=\"digiseller-category-blocks\">\n";
			foreach($answer -> subcategories -> subcategory as $subcategory){
				$result .= "<div>
					<a href=\"listing.php?category_id=".$subcategory -> id."\"><img src=\"http://graph.digiseller.ru/img.ashx?idn=1&amp;maxlength=".$GLOBALS["img_size"]."\" alt=\"\"></a>
					<a href=\"listing.php?category_id=".$subcategory -> id."\">".$subcategory -> name."<span>&nbsp;(".$subcategory["cnt"].")</span></a>
				</div>\n";}
				$result .= "</div>
				<div class=\"digiseller-both\"></div>\n";}
		
		if($answer -> categories -> category["cnt"] == 0){
		$result .= "<p>".$GLOBALS["mess"]["goods_not_found"]."</p>\n";}
		
		else{
			if($_REQUEST["page"] > $answer -> pages["cnt"]){
			$result .= "<p>".$GLOBALS["mess"]["page_not_found"]."</p>\n";}
			
			else{
			$result .= "<div id=\"digiseller-productList\">
						<div class=\"digiseller-options\">
					
						<div class=\"digiseller-sortby\" id=\"digiseller-sort\">
							<form action=\"./goods_order.php\" method=\"post\" style=\"margin:0px;padding:0px;\">
							<span>Сортировать по:</span>".get_order()."
							</form>
						</div>

						<div id=\"digiseller-currency\">
							<form action=\"./type_rate.php\" method=\"post\" style=\"margin:0px;padding:0px;\">
							<span>Валюта:</span>".get_type_rate()."
							</form>
						</div>
					
						</div>\n";
		
					foreach($answer -> products -> product as $product){
						$img = "<img src=\"http://graph.digiseller.ru/img.ashx?id_d=".$product -> id."&amp;maxlength=".$GLOBALS["img_size"]."\" alt=\"\" />\n";
							switch($product["icon"]){
							case "new":
							$html_class_name = "new";
							$vitrina_icon = "Новинка!";
							break;
							
							case "sale":
							$html_class_name = "action";
							$vitrina_icon = "Акция!";
							break;
							
							case "top":
							$html_class_name = "lider";
							$vitrina_icon = "Лидер продаж!";
							break;
							
							default:
							$html_class_name = "Icon";
							$vitrina_icon = "&nbsp;";}
				
				$curr_name = $answer -> products -> currency;
				$self_url = urlencode("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				
				$result .= "<div class=\"digiseller-product\">

						<div class=\"digiseller-pricelabel\">
							<span class=\"digiseller-article-cost\">".$product -> price."</span>
							<span class=\"digiseller-currency\">".$curr_name."</span>
							<a href=\"https://www.oplata.info/asp/pay_x20.asp?id_d=".$product -> id."&amp;dsn=limit\" class=\"digiseller-buyButton\">Купить</a>
						</div>	
											
						<div class=\"digiseller-article-img\">
							<a href=\"./goods_info.php?id=".$product -> id."\">
							$img
							</a>
						</div>
						
						<div class=\"digiseller-browseProdTitle\">
							<a href=\"./goods_info.php?id=".$product -> id."\" title=\"".$product -> name."\">".$product -> name."
								<span class=\"digiseller-label$html_class_name\">$vitrina_icon</span>
							</a>
							<p>
							".cutString(nl2br($product -> info),300)." ...
						
							<br/>
								<a class=\"digiseller-product-details\" href=\"./goods_info.php?id=".$product -> id."\" title=\"Подробнее\">Подробнее »</a>
							</p>
						</div>

					</div>\n";}
		
				// вывод номерации страниц
				$result .= "<div class=\"digiseller-both\"></div>\n";
					if((int)($answer -> pages["cnt"]) > 0){
					$result .= "<div class=\"digiseller-paging\">\n";
					$cp = (int)($answer -> pages -> num);
					$ap = (int)($answer -> pages["cnt"]);
					$url = "category_id=".$_REQUEST["category_id"];
					$result .= show_num_pages($cp,$ap,$GLOBALS["count_page"],$url,"./listing.php");
					
					$result .= "<div class=\"digiseller-pager-rows\">
					<form action=\"./goods_count.php\" method=\"post\">
					<span>Выводить на странице:</span>&nbsp;
					".get_goods_count()."
					</form>
					</div>\n";
					$result .= "</div>
					</div>\n";}}}}
echo $result;}
// функция шаблонизации
tmp_open($tmp_type,$tmp_dir,$tmp_file,$head);
?>