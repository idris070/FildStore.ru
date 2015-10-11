<?php
require_once "./inc/functions.php";

$tmp_type = "php";
$tmp_file = "0.tmp";

// заголовок страницы, ID продавца и пр. параметры
if(!empty($_GET["q"])){
$q = trim(strip_tags($_GET["q"]));
$head["title"] = $q;}
else{$head["title"] = "Поиск товаров";}
$GLOBALS["goods_count"] = $search["goods_count"];
$GLOBALS["count_page"] = $search["count_page"];
// установленная страница(по умолчанию - 1)
get_current_page();
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
$req_str = "";

if(!empty($_GET["q"])){
$q = trim(strip_tags($_GET["q"]));}

if(isset($q)){
	if(empty($q)){
	$result .= "<div id=\"digiseller-search-results\">
		<span class=\"digiseller-nothing-found\">".$GLOBALS["mess"]["search_empty"]."</span>
	</div>\n";}
	elseif(strlen($_GET["q"]) < 3){
	$result .= "<div id=\"digiseller-search-results\">
		<span class=\"digiseller-nothing-found\">".$GLOBALS["mess"]["search_short"]."</span>
	</div>\n";}
	else{
	$answer = $GLOBALS["obj"] -> search($GLOBALS["seller_id"],$q,$_REQUEST["page"],$GLOBALS["goods_count"],$GLOBALS["curr_name"]);
	$answer = $GLOBALS["obj"] -> parse_xml($answer);
		
		if($answer -> retval != 0){
		$result .= "<div id=\"digiseller-search-results\">
			<span class=\"digiseller-nothing-found\">Ошибка: ".$answer -> retdesc."</span>
		</div>\n";}
		else{
			// страниц - 0
			if((int)$answer -> pages["cnt"] == 0){
			$req_str .= "По запросу&nbsp;&quot;<span class=\"digiseller-bold\" id=\"digiseller-search-query\">$q</span>&quot;&nbsp;найдено товаров:&nbsp;<span class=\"digiseller-bold\" id=\"digiseller-search-total\">0</span>\n";
			$result .= "<div id=\"digiseller-search-results\">
			<span class=\"digiseller-nothing-found\">".$GLOBALS["mess"]["search_not_result"]."</span>
			</div>\n";}
			elseif($_REQUEST["page"] <= (int)($answer -> pages["cnt"])){
			$req_str .= "По запросу&nbsp;&quot;<span class=\"digiseller-bold\" id=\"digiseller-search-query\">$q</span>&quot;&nbsp;найдено товаров:&nbsp;<span class=\"digiseller-bold\" id=\"digiseller-search-total\">".$answer -> products["cnt"]."</span>\n";
			$self_url = urlencode("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
			foreach($answer -> products -> product as $product){
				if(!empty($product -> snippets -> info)){
					$product_info = str_replace(array("\n", "[[!b!]]", "[[!/b!]]"), array("<br />", "<strong>", "</strong>"),$product -> snippets -> info);}
				else{$product_info = "";}
				switch($product["icon"]){
								case "sale":
								$html_class_name = "new";
								$vitrina_icon = "Новинка!";
								break;
						
								case "new":
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
				$name = str_replace(array("\n", "[[!b!]]", "[[!/b!]]"), array("<br />", "<strong>", "</strong>"),$product -> snippets -> name);
				$result .= "<div class=\"digiseller-product\">

						<div class=\"digiseller-pricelabel\">
							<span class=\"digiseller-article-cost\">".$product -> price."</span>
							<span class=\"digiseller-currency\">".$GLOBALS["curr_name"]."</span>
						</div>	
						
						<div class=\"digiseller-article-img\">
							<a href=\"#\" title=\"Увеличить\">
							<img src=\"http://graph.digiseller.ru/img.ashx?id_d=".$product -> id."&amp;maxlength=180\" alt=\"\" />
							</a>
						</div>
						
						<div class=\"digiseller-browseProdTitle\">
							<a href=\"./goods_info.php?id=".$product -> id."\" title=\"".$product -> name."\">$name
								<span class=\"digiseller-label$html_class_name\">$vitrina_icon</span>
							</a>
							<p>
							$product_info</br>
						
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
					$url = "";
					$result .= show_num_pages($cp,$ap,$GLOBALS["count_page"],$url,"./listing.php");
					
					$result .= "<div class=\"digiseller-pager-rows\">
					<form action=\"./goods_count.php\" method=\"post\">
					<span>Выводить на странице:</span>&nbsp;
					".get_goods_count()."
					</form>
					</div>\n";
					$result .= "</div>\n";}}
			
			else{
				$result .= "<div id=\"digiseller-search-results\">
				<span class=\"digiseller-nothing-found\">".$GLOBALS["mess"]["page_not_found"]."</span>
				</div>\n";}}}}
else{
	$result .= "<div id=\"digiseller-search-results\">
		<span class=\"digiseller-nothing-found\">".$GLOBALS["mess"]["search_not_set"]."</span>
	</div>\n";}
?>
			<h1>Поиск</h1>
			<div class="digiseller-breadcrumbs">
				<a href="./" title="Магазин">Магазин</a> > <strong>Поиск</strong>
			</div>
			<div class="digiseller-options"><div class="digiseller-sortby"><?php echo $req_str; ?>&nbsp;</div>		

						<div id="digiseller-currency">
							<form action="./type_rate.php" method="post" style="margin:0px;padding:0px;">
							<span>Валюта:</span>
								<?php echo get_type_rate(); ?>
							</form>
						</div>
					
				</div>
				
			
				<div class="digiseller-productList">
					
				<?php echo $result; ?>
				
				</div>
<?php }

// функция шаблонизации
tmp_open($tmp_type,$tmp_dir,$tmp_file,$head);
?>