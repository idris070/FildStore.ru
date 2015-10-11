<?php
// файл с набором функций
require_once "./config.php";
require_once $inc_path."core/main.php";
require_once $inc_path."core/controller.php";
require_once $inc_path."core/message.php";

$GLOBALS["obj"] = new core;
$GLOBALS["mess"] = $_mess;
$GLOBALS["seller_id"] = $seller_id;
$GLOBALS["default_rt"] = $default_rt;
$GLOBALS["tmp_dir"] = $tmp_dir;
$GLOBALS["logo"] = $logo;
$GLOBALS["search_status"] = $search_status;
$GLOBALS["top_menu_status"] = $top_menu_status;
$GLOBALS["categories_status"] = $categories_status;
$GLOBALS["view_mode"] = $view_mode;

session_start();
get_agent_id();

function get_type_rate(){
$result = "";
// если валюта была установлена в выпадающем списке
$result .= "<select name=\"rt\" onchange=\"this.form.submit()\">\n";
	if(isset($_SESSION["rt"])){
		if($_SESSION["rt"] != "wmz" and $_SESSION["rt"] != "wme" and $_SESSION["rt"] != "wmu"){
		$result .= "<option value=\"wmr\" selected=\"selected\">RUR</option>\n";}
		else{$result .= "<option value=\"wmr\">RUR</option>\n";}
		if($_SESSION["rt"] == "wmz"){
		$result .= "<option value=\"wmz\" selected=\"selected\">USD</option>\n";}
		else{$result .= "<option value=\"wmz\">USD</option>\n";}
		if($_SESSION["rt"] == "wme"){
		$result .= "<option value=\"wme\" selected=\"selected\">EUR</option>\n";}
		else{$result .= "<option value=\"wme\">EUR</option>\n";}
		if($_SESSION["rt"] == "wmu"){
		$result .= "<option value=\"wmu\" selected=\"selected\">UAH</option>\n";}
		else{$result .= "<option value=\"wmu\">UAH</option>\n";}}
	else{
		if(isset($GLOBALS["default_rt"])){
			if($GLOBALS["default_rt"] != "wmz" and $GLOBALS["default_rt"] != "wme" and $GLOBALS["default_rt"] != "wmu"){
			$result .= "<option value=\"wmr\" selected=\"selected\">RUR</option>\n";}
			else{$result .= "<option value=\"wmr\">RUR</option>\n";}
			if($GLOBALS["default_rt"] == "wmz"){
			$result .= "<option value=\"wmz\" selected=\"selected\">USD</option>\n";}
			else{$result .= "<option value=\"wmz\">USD</option>\n";}
			if($GLOBALS["default_rt"] == "wme"){
			$result .= "<option value=\"wme\" selected=\"selected\">EUR</option>\n";}
			else{$result .= "<option value=\"wme\">EUR</option>\n";}
			if($GLOBALS["default_rt"] == "wmu"){
			$result .= "<option value=\"wmu\" selected=\"selected\">UAH</option>\n";}
			else{$result .= "<option value=\"wmu\">UAH</option>\n";}}
		else{
$result .= "<option value=\"wmr\" selected=\"selected\">RUR</option>
<option value=\"wmz\">USD</option>
<option value=\"wme\">EUR</option>
<option value=\"wmu\">UAH</option>\n";}}
$result .= "</select>";
return $result;}

function show_name_rate(){
if(isset($_SESSION["rt"]) && !empty($_SESSION["rt"])){
	if($_SESSION["rt"] != "USD" && $_SESSION["rt"] != "EUR" && $_SESSION["rt"] != "UAH"){
	$currency = "RUR";}
	elseif($_SESSION["rt"] == "USD"){
	$currency = "USD";}
	elseif($_SESSION["rt"] == "EUR"){
	$currency = "EUR";}
	elseif($_SESSION["rt"] == "UAH"){
	$currency = "UAH";}}
else{
	if(isset($GLOBALS["default_rt"]) && ! empty($GLOBALS["default_rt"])){
		if($GLOBALS["default_rt"] != "USD" && $GLOBALS["default_rt"] != "EUR" && $GLOBALS["default_rt"] != "UAH"){
		$currency = "RUR";}
		elseif($GLOBALS["default_rt"] == "USD"){
		$currency = "USD";}
		elseif($GLOBALS["default_rt"] == "EUR"){
		$currency = "EUR";}
		elseif($GLOBALS["default_rt"] == "UAH"){
		$currency = "UAH";}}
		else{$currency = "RUR";}}
$GLOBALS["currency"] = $currency;}

function show_other_name_rate(){
if(isset($_SESSION["rt"]) && !empty($_SESSION["rt"])){
if($_SESSION["rt"] != "wmz" && $_SESSION["rt"] != "wme" && $_SESSION["rt"] != "wmu"){
$currency = "wmr";
$curr_name = "RUR";}
elseif($_SESSION["rt"] == "wmz"){
$currency = "wmz";
$curr_name = "USD";}
elseif($_SESSION["rt"] == "wme"){
$currency = "wme";
$curr_name = "EUR";}
elseif($_SESSION["rt"] == "wmu"){
$currency = "wmu";
$curr_name = "UAH";}}
else{
if(isset($GLOBALS["default_rt"]) && ! empty($GLOBALS["default_rt"])){
if($GLOBALS["default_rt"] != "wmz" && $GLOBALS["default_rt"] != "wme" && $GLOBALS["default_rt"] != "wmu"){
$currency = "wmr";
$curr_name = "RUR";}
elseif($GLOBALS["default_rt"] == "wmz"){
$currency = "wmz";
$curr_name = "USD";}
elseif($GLOBALS["default_rt"] == "wme"){
$currency = "wme";
$curr_name = "EUR";}
elseif($GLOBALS["default_rt"] == "wmu"){
$currency = "wmu";
$curr_name = "UAH";}}
else{$currency = "wmr";
$curr_name = "RUR";}}
$GLOBALS["currency"] = $currency;
$GLOBALS["curr_name"] = $curr_name;}

function get_type_responses(){
$result = "";
// если тип отзывов не был установлена в выпадающем списке
$result .= "<select name=\"type_responses\" onchange=\"this.form.submit()\">\n";
	if(isset($_SESSION["type_responses"])){
		if($_SESSION["type_responses"] != "good" and $_SESSION["type_responses"] != "bad"){
		$result .= "<option value=\"all\" selected=\"selected\">Все отзывы</option>\n";}
		else{
		$result .= "<option value=\"all\">Все отзывы</option>\n";}
		if($_SESSION["type_responses"] == "good"){
		$result .= "<option value=\"good\" selected=\"selected\">Положительные</option>\n";}
		else{
		$result .= "<option value=\"good\">Положительные</option>\n";}
		if($_SESSION["type_responses"] == "bad"){
		$result .= "<option value=\"bad\" selected=\"selected\">Отрицательные</option>\n";}
		else{
		$result .= "<option value=\"bad\">Отрицательные</option>\n";}}
	else{
		if(isset($GLOBALS["type_responses"])){
			if($GLOBALS["type_responses"] != "good" and $GLOBALS["type_responses"] != "bad"){
			$result .= "<option value=\"all\" selected=\"selected\">Все отзывы</option>\n";}
			else{
			$result .= "<option value=\"all\">Все отзывы</option>\n";}
			if($GLOBALS["type_responses"] == "good"){
			$result .= "<option value=\"good\" selected=\"selected\">Положительные</option>\n";}
			else{
			$result .= "<option value=\"good\">Положительные</option>\n";}
			if($GLOBALS["type_responses"] == "bad"){
			$result .= "<option value=\"bad\" selected=\"selected\">Отрицательные</option>\n";}
			else{
			$result .= "<option value=\"bad\">Отрицательные</option>\n";}}
		else{
		$result .= "<option value=\"all\" selected=\"selected\">Все отзывы</option>
			<option value=\"good\">Положительные</option>
			<option value=\"wme\">Отрицательные</option>\n";}}
$result .= "</select>\n";
return $result;}

function get_order(){
$result = "";
// если порядок сортировки был установлен в выпадающем списке
$result .= "<select name=\"order\" onchange=\"this.form.submit()\">\r\n";
	if(isset($_SESSION["order"])){
		if($_SESSION["order"] != "nameDESC" && $_SESSION["order"] != "price" && $_SESSION["order"] != "priceDESC"){
		$result .= "<option value=\"name\" selected=\"selected\">названию от А до Я</option>\r\n";}
		else{$result .= "<option value=\"name\">названию от А до Я</option>\r\n";}
		if($_SESSION["order"] == "nameDESC"){
		$result .= "<option value=\"nameDESC\" selected=\"selected\">названию от Я до А</option>\r\n";}
		else{$result .= "<option value=\"nameDESC\">названию от Я до А</option>\r\n";}
		if($_SESSION["order"] == "price"){
		$result .= "<option value=\"price\" selected=\"selected\">цене от низкой до высокой</option>\r\n";}
		else{$result .= "<option value=\"price\">цене от низкой до высокой</option>\r\n";}
		if($_SESSION["order"] == "priceDESC"){
		$result .= "<option value=\"priceDESC\" selected=\"selected\">цене от высокой до низкой</option>\r\n";}
		else{$result .= "<option value=\"priceDESC\">цене от высокой до низкой</option>\r\n";}}
	else{
		if(isset($GLOBALS["order"])){
			if($GLOBALS["order"] != "nameDESC" && $GLOBALS["order"] != "price" && $GLOBALS["order"] != "priceDESC"){
			$result .= "<option value=\"name\" selected=\"selected\">названию от А до Я</option>\r\n";}
			else{$result .= "<option value=\"name\">названию от А до Я</option>\r\n";}
			if($GLOBALS["order"] == "nameDESC"){
			$result .= "<option value=\"nameDESC\" selected=\"selected\">названию от Я до А</option>\r\n";}
			else{$result .= "<option value=\"nameDESC\">названию от Я до А</option>\r\n";}
			if($GLOBALS["order"] == "price"){
			$result .= "<option value=\"price\" selected=\"selected\">цене от низкой до высокой</option>\r\n";}
			else{$result .= "<option value=\"price\">цене от низкой до высокой</option>\r\n";}
			if($GLOBALS["order"] == "price"){
			$result .= "<option value=\"priceDESC\" selected=\"selected\">цене от высокой до низкой</option>\r\n";}
			else{$result .= "<option value=\"priceDESC\">цене от высокой до низкой</option>\r\n";}}
		else{
		$result .= "<option value=\"name\" selected=\"selected\">названию от А до Я</option>
		<option value=\"nameDESC\">названию от Я до А</option>
		<option value=\"price\">цене от низкой до высокой</option>
		<option value=\"priceDESC\">цене от высокой до низкой</option>\r\n";}}
$result .= "</select>";
return $result;}

function get_goods_count(){
$result = "";
// если порядок сортировки был установлен в выпадающем списке
$result .= "<select name=\"goods_count\" onchange=\"this.form.submit()\">\r\n";
	if(isset($_SESSION["goods_count"])){
		if($_SESSION["goods_count"] != 20 && $_SESSION["goods_count"] != 50 && $_SESSION["goods_count"] != 100){
		$result .= "<option value=\"10\" selected=\"selected\">10</option>\r\n";}
		else{$result .= "<option value=\"10\">10</option>\r\n";}
		if($_SESSION["goods_count"] == 20){
		$result .= "<option value=\"20\" selected=\"selected\">20</option>\r\n";}
		else{$result .= "<option value=\"20\">20</option>\r\n";}
		if($_SESSION["goods_count"] == 50){
		$result .= "<option value=\"50\" selected=\"selected\">50</option>\r\n";}
		else{$result .= "<option value=\"50\">50</option>\r\n";}
		if($_SESSION["goods_count"] == 100){
		$result .= "<option value=\"100\" selected=\"selected\">100</option>\r\n";}
		else{$result .= "<option value=\"100\">100</option>\r\n";}}
	else{
		if(isset($GLOBALS["goods_count"])){
			if($GLOBALS["goods_count"] != 20 && $GLOBALS["goods_count"] != 50 && $GLOBALS["goods_count"] != 100){
			$result .= "<option value=\"10\" selected=\"selected\">10</option>\r\n";}
			else{$result .= "<option value=\"10\">10</option>\r\n";}
			if($GLOBALS["goods_count"] == 20){
			$result .= "<option value=\"20\" selected=\"selected\">20</option>\r\n";}
			else{$result .= "<option value=\"20\">20</option>\r\n";}
			if($GLOBALS["goods_count"] == 50){
			$result .= "<option value=\"50\" selected=\"selected\">50</option>\r\n";}
			else{$result .= "<option value=\"50\">50</option>\r\n";}
			if($GLOBALS["goods_count"] == 100){
			$result .= "<option value=\"100\" selected=\"selected\">100</option>\r\n";}
			else{$result .= "<option value=\"100\">100</option>\r\n";}}}
$result .= "</select>";
return $result;}

function show_num_pages($current_page,$all_pages,$count_page,$add_url,$url_page){
$result = "";
	if($current_page - $count_page > 0){
	$result .= "<a href=\"".$url_page."?".$add_url."\" title=\"1\">1</a>\n";}

for($i = ($current_page - $count_page); $i <= ($current_page + $count_page); $i++){
	if($i > 0 && $i <= $all_pages){
		if($i == ($current_page - $count_page)){
		$result .= "<span>...</span>\n";}
		elseif($i == ($current_page + $count_page)){
		$result .= "<span>...</span>\n";}
		elseif($i == $current_page){
		$result .= "<a href=\"#\" class=\"digiseller-activepage\">".$i."</a>\n";}
		else{
		$result .= "<a href=\"".$url_page."?".$add_url."&amp;page=".$i."\" title=\"".$i."\">".$i."</a>\n";}}}

	if($current_page + $count_page <= $all_pages){
	$result .= "<a href=\"".$url_page."?".$add_url."&amp;page=".$all_pages."\" title=\"$all_pages\">$all_pages</a>\n";}
return $result;}

function get_agent_id(){
if(!empty($_REQUEST["ai"]) && !preg_match("/[^0-9]/",trim($_REQUEST["ai"]))){
setcookie ("ai",$_REQUEST["ai"],time()+31536000);
$_SESSION["ai"] = $_REQUEST["ai"];
$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($url,"?ai")){
$url_array = explode("?ai",$url);
header("Location: ".$url_array[0]);}
elseif(strpos($url,"&ai")){
$url_array = explode("&ai",$url);
header("Location: ".$url_array[0]);}}}

function get_name_categories($cat){
$result = "";
	while($cat){
		if(isset($_GET["category_id"])){
			if((int)$cat -> id != $_GET["category_id"]){
				$result .= " > <a href=\"./listing.php?category_id=".$cat -> id."\" title=\"".$cat -> name."\">".$cat -> name."</a>";}
			else{$result .= " > <strong>".$cat -> name." (".$cat["cnt"].")</strong>";}}
		else{$result .= " > <a href=\"./listing.php?category_id=".$cat -> id."\" title=\"".$cat -> name."\">".$cat -> name."</a>";}
		$cat = $cat -> category;
		get_name_categories($cat);}
return $result;}

function get_category_name($cat){
$result = "";
	while($cat){
		if(isset($_GET["category_id"])){
			if((int)$cat -> id == $_GET["category_id"]){
				$result .= "<h1>".$cat -> name."</h1>";}}
		else{$result .= "<h1>".$cat -> name."</h1>\n";}
		$cat = $cat -> category;
		get_name_categories($cat);}
return $result;}

function get_tree($cat){
if(isset($_GET["category_id"]) && !empty($_GET["category_id"])){
$category_id = abs((int)$_GET["category_id"]);
if(!$category_id){
$category_id = 0;}}
else{$category_id = 0;}
    $tree = "";
    foreach($cat as $category){
		if(isset($_GET["category_id"]) and $category -> id == $_GET["category_id"]){
		$html_class_name = " class=\"digiseller-category-active\"";}
		else{
		$html_class_name = "";}
      $category_url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/listing.php?category_id=".$category -> id;
        if($category["sub"] == "yes"){
            if(isset($_COOKIE["sub_".$category -> category -> id]) && $_COOKIE["sub_".$category -> category -> id] && $_COOKIE["sub_".$category -> category -> id] == "block"){
				$display = "block";}
            else{$display = "none";}
            $tree .= "<li$html_class_name><a href=\"#\" title=\"\" onclick=\"SubCat('".abs((int)$category -> category -> id)."', '".$category_url."');\">".$category -> name." <span>(".$category["cnt"].")</span></a>\n<div id=\"sub_".$category -> category -> id."\" style=\"display:".$display.";\">\n<ul>\n".get_tree($category -> category)."\n</ul>\n</div>\n</li>\n";}
        else{$tree .= "<li$html_class_name><a href=\"#\" title=\"\" onclick=\"SubCat('".abs((int)$category -> category -> id)."', '".$category_url."');\">".$category -> name." <span>(".$category["cnt"].")</span></a></li>";}}
return $tree;}

function show_goods_group($status = true){
	if($status === true){
		$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_group($GLOBALS["seller_id"]));
			if($answer -> retval != 0){
			echo "<p><span class=\"warning\">".$GLOBALS["mess"]["service_error"]."</span></p>\r\n";}
			else{
$cat = $answer -> categories -> category;

// вывод ID групп товаров
echo "<ul>\n".get_tree($cat)."</ul>\r\n";}}
	else {echo "&nbsp;";}}

function show_groups($limit){
if(!empty($limit) && $limit > 0){
$pin_limit = $limit;
$ebooks_limit = $limit;
$digi_limit = $limit;
$soft_limit = $limit;}
else{
$pin_limit = 0;
$ebooks_limit = 0;
$digi_limit = 0;
$soft_limit = 0;}
if(!empty($_COOKIE["ai"]) && $_COOKIE["ai"] > 0){
$agent = "id_agent=".$_COOKIE["ai"];}
elseif(!empty($GLOBALS["seller_id"]) && $GLOBALS["seller_id"] > 0){
$agent = "id_agent=".$GLOBALS["seller_id"];}
else{
$agent = "";}
$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> get_products_form());
foreach($answer -> catalogs as $catalogs){
// пин-коды
if(!empty($catalogs -> catalog[2] -> name)){
echo "<div id=\"pins\">
<p><strong>".$catalogs -> catalog[2] -> name."</strong></p>
<p>\r\n";
foreach($catalogs -> catalog[2] -> products -> product as $product){
if(!empty($pin_limit) && $pin_limit > 0){
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";
$pin_limit--;
if($pin_limit == 0){
break;}}
else{
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";}}
echo "<a href=\"http://www.digiseller.ru/outside/default.asp?".$agent."\" class=\"etc\" title=\"другие...\">...</a>
</p>
</div>\r\n";}
// электронные книги
if(!empty($catalogs -> catalog[0] -> name)){
echo "<div id=\"ebooks\">
<p><strong>".$catalogs -> catalog[0] -> name."</strong></p>
<p>\r\n";
foreach($catalogs -> catalog[0] -> products -> product as $product){
if(!empty($ebooks_limit) && $ebooks_limit > 0){
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";
$ebooks_limit--;
if($ebooks_limit == 0){
break;}}
else{
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";}}
echo "<a href=\"http://www.digiseller.ru/outside/default.asp?".$agent."\" class=\"etc\" title=\"другие...\">...</a>
</p>
</div>\r\n";}
// цифровые товары
if(!empty($catalogs -> catalog[3] -> name)){
echo "<div id=\"digi\">
<p><strong>".$catalogs -> catalog[3] -> name."</strong></p>
<p>\r\n";
foreach($catalogs -> catalog[3] -> products -> product as $product){
if(!empty($digi_limit) && $digi_limit > 0){
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";
$digi_limit--;
if($digi_limit == 0){
break;}}
else{
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";}}
echo "<a href=\"http://www.digiseller.ru/outside/default.asp?".$agent."\" class=\"etc\" title=\"другие...\">...</a>
</p>
</div>\r\n";}
// программное обеспечение
if(!empty($catalogs -> catalog[1] -> name)){
echo "<div id=\"soft\">
<p><strong>".$catalogs -> catalog[1] -> name."</strong></p>
<p>\r\n";
foreach($catalogs -> catalog[1] -> products -> product as $product){
if(!empty($soft_limit) && $soft_limit > 0){
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";
$soft_limit--;
if($soft_limit == 0){
break;}}
else{
echo "<a class=\"section\" title=\"".$product."\" href=\"http://www.digiseller.ru/outside/default.asp?searchstr=".$product."&amp;".$agent."\">".$product."</a>, ";}}
echo "<a href=\"http://www.digiseller.ru/outside/default.asp?".$agent."\" class=\"etc\" title=\"другие...\">...</a>
</p>
</div>\r\n";}}}

function get_current_page(){
if(isset($_REQUEST["page"]) && !empty($_REQUEST["page"])){
$_REQUEST["page"] = preg_replace("/[^0-9]/","",$_REQUEST["page"]);
if(empty($_REQUEST["page"])){
$_REQUEST["page"] = 1;}}
else{$_REQUEST["page"] = 1;}}

function cutString($string,$maxlen){
    $len = (mb_strlen($string) > $maxlen) ? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($string,0,$len);
    return (mb_strlen($string) > $maxlen) ? '"' . $cutStr . '..."' : '"' . $cutStr . '"';}

function show_logo($url,$status){
	if(strlen(trim($url)) > 0 and file_exists($url) and $status === true){
	echo "<a href=\"./index.php\" title=\"Магазин моментальных покупок\"><img src=\"$url\" alt=\"\" /></a>\n";}
	else{echo "&nbsp;\n";}}

function show_search_form($status = true){
$result = "";
	if($status === true) {
if(!empty($_GET["q"])){$q = trim(strip_tags($_GET["q"]));} else{$q = "Что ищем?";}
				$result .= "<div id=\"digiseller-search\" class=\"digiseller-search\">
				<div id=\"digiseller-search\">
					<form action=\"./search.php\" method=\"get\" class=\"digiseller-search-form\">
						<input type=\"text\" name=\"q\" value=\"$q\" title=\"$q\" class=\"digiseller-search-input\" onblur=\"this.value=(this.value=='')?this.title:this.value;\" onfocus=\"this.value=(this.value==this.title)?'':this.value;\" />						<input type=\"submit\" class=\"digiseller-search-go\" value=\"\" />
					</form>
				</div>
			</div>\n";}
	else{$result = "&nbsp;";}
echo $result;}

function show_top_menu($status = true){
$result = "";
	if($status === true) {
				$result .= "<div class=\"digiseller-topmenu\" class=\"digiseller-topmenu\">
				<div class=\"digiseller-topmenu\">
					<a href=\"https://www.oplata.info/\" title=\"Мои покупки\" class=\"digiseller-myorderslnk\">Мои покупки</a>
					<a href=\"./responses.php\" title=\"Отзывы покупателей\" class=\"digiseller-reviewslnk\">Отзывы покупателей</a>
					<a href=\"./contacts.php\" title=\"Контакты\" class=\"digiseller-contactslnk\">Контакты</a>
				</div>
			</div>\n";}
	else{$result = "&nbsp;";}
echo $result;}

function get_css(){
if(!file_exists($GLOBALS["tmp_dir"]."css/styles.css")){
$url = "http://shop.digiseller.ru/xml/shop_css.asp?seller_id=".$GLOBALS["seller_id"];

if(!file_put_contents($GLOBALS["tmp_dir"]."css/styles.css",file_get_contents($url))) return false;}}
?>
