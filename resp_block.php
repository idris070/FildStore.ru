<?php
require_once "./inc/functions.php";

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
?>
			<!-- Список товаров -->
			<div class="digiseller-reviewList">
				<h1>Отзывы покупателей</h1>
				<div class="digiseller-options">
						<div class="digiseller-filtersort">
							<form action="./type_resp.php" method="post">
							<span>Показать:</span>
							<?php echo get_type_responses(); ?>
							</form>
						</div>		
				</div>
				
<?php
$result = "";

$answer_resp = $GLOBALS["obj"] -> goods_responses($GLOBALS["seller_id"],$GLOBALS["id_goods"],$GLOBALS["type_responses"],$_REQUEST["page"],$GLOBALS["rows"]);
$answer_resp = $GLOBALS["obj"] -> parse_xml($answer_resp);
	if($answer_resp -> retval != 0){
	$result .= "<p>".$answer_resp -> retdesc."</p>\n";}
	else{
		$url = "";
			if(!empty($answer_resp -> product -> id)){
			$url .= "&amp;id_goods=".$answer_resp -> product -> id;}
		if((int)($answer_resp -> pages["cnt"]) == 0){
		$result .= "<p>".$GLOBALS["mess"]["resp_not_found"]."</p>\n";}
		elseif((int)($answer_resp -> pages -> num) > (int)($answer_resp -> pages["cnt"])){
		$result .= "<p>".$GLOBALS["mess"]["page_not_found"]."</p>\n";}
		else{
			foreach($answer_resp -> reviews -> review as $review){
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
			if((int)($answer_resp -> pages["cnt"]) > 1){
			$result .= "<div class=\"digiseller-paging\">\n";
			$cp = (int)($answer_resp -> pages -> num);
			$ap = (int)($answer_resp -> pages["cnt"]);
			$url = "type=".$GLOBALS["type_responses"];
			$result .= show_num_pages($cp,$ap,$GLOBALS["count_page"],$url,"./responses.php");
			$result .= "</div>\n";}
					
			}}
echo $result;
?>
				</div>
			<!-- end.Список товаров -->				