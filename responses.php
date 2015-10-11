<?php
require_once "./inc/functions.php";

$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
// заголовок страницы, ID продавца и пр. параметры
$head["title"] = "Отзывы покупателей";
$GLOBALS["type_responses"] = $responses["default_type"];
// ID товара
if(isset($_REQUEST["id_goods"]) && !empty($_REQUEST["id_goods"])){
$GLOBALS["id_goods"] = $_REQUEST["id_goods"];}
else{$GLOBALS["id_goods"] = "";}
// тип отзывов
if(isset($_SESSION["type_responses"]) and !empty($_SESSION["type_responses"])){
	switch($_SESSION["type_responses"]){
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
else{
	switch($GLOBALS["type_responses"]){
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
// установленная страница(по умолчанию - 1)
get_current_page();
// количество строк и количество страниц
$GLOBALS["rows"] = $default_rows;
$GLOBALS["count_page"] = $responses["pages"];
// функция вывода контента
function show_content(){
$result = "";
?>
			<!-- Список товаров -->
				
			<div class="digiseller-reviewList">
				<h1>Отзывы покупателей</h1>
				<div class="digiseller-breadcrumbs">
					<a href="./" title="Магазин">Магазин</a> > <strong>Отзывы</strong>
				</div>
				<div class="digiseller-options">
						<div class="digiseller-filtersort" id="digiseller-reviews-type">
							<form action="./type_resp.php" method="post" style="margin:0px;padding:0px;">
							<span>Показать:</span>
							<?php echo get_type_responses(); ?>
							</form>
						</div>		
				</div>
			
<?php
$answer = $GLOBALS["obj"] -> goods_responses($GLOBALS["seller_id"],$GLOBALS["id_goods"],$GLOBALS["type_responses"],$_REQUEST["page"],$GLOBALS["rows"]);
$answer = $GLOBALS["obj"] -> parse_xml($answer);
	if($answer -> retval != 0){
	$result .= "<p>".$answer -> retdesc."</p>\n";}
	else{
		$url = "";
			if(!empty($answer -> product -> id)){
			$url .= "&amp;id_goods=".$answer -> product -> id;}
		if((int)($answer -> pages["cnt"]) == 0){
		$result .= "<p>".$GLOBALS["mess"]["resp_not_found"]."</p>\n";}
		elseif((int)($answer -> pages -> num) > (int)($answer -> pages["cnt"])){
		$result .= "<p>".$GLOBALS["mess"]["page_not_found"]."</p>\n";}
		else{
			foreach($answer -> reviews -> review as $review){
				switch($review -> type){
				case "good":
				$html_class = "good";
				$type_sym = "+";
				break;
				
				case "bad":
				$html_class = "bad";
				$type_sym = "-";
				break;}
			$result .= "<div class=\"digiseller-review\">
						<span class=\"digiseller-reviewdate\">".$review -> date."</span>
						<p>
						<span class=\"digiseller-review$html_class\">$type_sym</span>
						".nl2br($review -> info)." 
						</p>\n";
				
				if(!empty($review -> comment)){
				$comment = $review -> comment;
				$comment = nl2br($comment);
					$result .= "<div class=\"digiseller-reviewcomment\">
						<span class=\"digiseller-reviewcommentarrow\">▲</span>
						<span class=\"digiseller-reviewcommentadmintxt\">
							<span class=\"digiseller-reviewdate\">Комментарий администратора</span>
							".$comment."
						</span>
						</div>\n";}						

			$result .= "</div>
					<div class=\"digiseller-both\"></div>\n";}
			// вывод номерации страниц
			if((int)($answer -> pages["cnt"]) > 1){
			$result .= "<div class=\"digiseller-paging\">\n";
			$cp = (int)($answer -> pages -> num);
			$ap = (int)($answer -> pages["cnt"]);
			$url = "type=".$GLOBALS["type_responses"];
			$result .= show_num_pages($cp,$ap,$GLOBALS["count_page"],$url,"./responses.php");
			$result .= "</div>\n";}
					
			}}
echo $result;
?>
				</div>
			<!-- end.Список товаров -->
<?php }
// функция шаблонизации
tmp_open($tmp_type,$tmp_dir,$tmp_file,$head);
?>