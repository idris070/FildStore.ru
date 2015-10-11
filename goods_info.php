<?php
require_once "./inc/functions.php";

$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
// заголовок страницы, массив контактов
$head["title"] = "Описание товара";
$GLOBALS["img_size"] = $info_goods["img_size"];
show_other_name_rate();
// функция вывода контента
function show_content(){
$result = "";
?>
			<!-- Список товаров -->
			<div class="digiseller-productpage">
			<?php
				if(!isset($_GET["id"]) or empty($_GET["id"])){
				$result .= "<meta http-equiv=\"refresh\" content=\"0; url=index.php\" />\n";}
				else{
				$_GET["id"] = abs((int)$_GET["id"]);
					if(empty($_GET["id"])){
					$result .= "<meta http-equiv=\"refresh\" content=\"0; url=index.php\" />\n";}
					else{
					$answer = $GLOBALS["obj"] -> parse_xml($GLOBALS["obj"] -> goods_info($_GET["id"],$GLOBALS["currency"]));
						if($answer -> retval != 0){
						$result .= "<p>".$GLOBALS["mess"]["service_error"]."</p>\n";}
						else{
						$cat = $answer -> product -> categories -> category;
						$self_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
						
								$product = $answer -> product;
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
?>
							<h1><?php echo $answer -> product -> name;?>
								<span class="digiseller-label<?php echo $html_class_name;?>"><?php echo $vitrina_icon;?></span>
							</h1>
				<div class="digiseller-breadcrumbs">
					<a href="./" title="Магазин">Магазин</a><?php echo get_name_categories($cat); ?>
				</div>
				<div class="digiseller-options">
				
					<span class="digiseller-social">
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $self_url; ?>" title="FaceBook" class="digiseller-social-fb">&nbsp;</a>
						<a href="http://vkontakte.ru/share.php?url=<?php echo $self_url; ?>" title="вКонтакте" class="digiseller-social-vk">&nbsp;</a>
						<a href="http://twitter.com/home?status=<?php echo $self_url; ?>" title="twitter" class="digiseller-social-tw">&nbsp;</a>
						<a href="http://events.webmoney.ru/sharer.aspx?url=<?php echo $self_url; ?>" title="Webmoney" class="digiseller-social-wm">&nbsp;</a>
					</span>
					
				
						<div id="digiseller-currency">
							<form action="./type_rate.php" method="post" style="margin:0px;padding:0px;">
							<span>Валюта:</span>
								<?php echo get_type_rate(); ?>
							</form>
						</div>
					
				</div>
<?php					
						if(!empty($answer -> product -> previews_img -> preview_img -> img_real)){
						$prev_img_real = $answer -> product -> previews_img -> preview_img -> img_real;
						$a = "<a href=\"$prev_img_real\" id=\"digiseller-article-img-preview\" rel=\"prettyPhoto[a]\">
							<img src=\"http://graph.digiseller.ru/img.ashx?id_d=".$answer -> product -> id."&amp;maxlength=".$GLOBALS["img_size"]."\" alt=\"\" />\n					
							</a>\n";}
						else{$a = "<img src=\"http://graph.digiseller.ru/img.ashx?id_d=".$answer -> product -> id."&amp;maxlength=".$GLOBALS["img_size"]."\" alt=\"\" />\n";}
													
						$result .= "<div class=\"digiseller-product-details\">						
							<div class=\"digiseller-product-left\">
							$a";
							if(!empty($answer -> product -> previews_img["cnt"]) && $answer -> product -> previews_img["cnt"] > 1 or !empty($answer -> product -> previews_video["cnt"]) && $answer -> product -> previews_video["cnt"] > 0){
							$result .= "<div class=\"digiseller-left-thumbs\" id=\"digiseller-article-thumbs\">\n";
								if(!empty($answer -> product -> previews_img["cnt"]) && $answer -> product -> previews_img["cnt"] > 1){
									foreach($answer -> product -> previews_img -> preview_img as $preview_img){									
									$result .= "<a href=\"".$preview_img -> img_real."\" title=\"\" rel=\"prettyPhoto[a]\">
									<img src=\"http://graph.digiseller.ru/img.ashx?idp=".$preview_img["id"]."&amp;maxlength=80&amp;crop=1\" width=\"80\" height=\"80\" alt=\"\" />
								</a>\n";}}
								if(!empty($answer -> product -> previews_video["cnt"]) && $answer -> product -> previews_video["cnt"] > 0){
									foreach($answer -> product -> previews_video -> preview_video as $preview_video){
										if($preview_video -> type == "youtube"){
										$video_url = "http://www.youtube.com/watch?v=".$preview_video -> id;}
										elseif($preview_video -> type == "vimeo"){
										$video_url = "http://vimeo.com/".$preview_video -> id;}
									
									$result .= "<a href=\"$video_url\" title=\"#\" class=\"digiseller-videothumb\" rel=\"prettyPhoto[a]\">
								<img src=\"".$preview_video -> preview."\" alt=\"\" />
								<span></span>
							</a>\n";}}
							$result .= "</div>\n";}
							
						$self_url = urlencode("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
						$result .= "</div>
						
							<div class=\"digiseller-product-right\">
							<div class=\"digiseller-productBuy\">
								<span class=\"digiseller-prod-cost\">".$answer -> product -> prices -> $GLOBALS["currency"]." ".$GLOBALS["curr_name"]."</span>	
								<a href=\"https://www.oplata.info/asp/pay_x20.asp?id_d=".$product -> id."&amp;dsn=limit\" class=\"digiseller-buyButton\">Купить</a>
							</div>
							<div>
							
									<div class=\"digiseller-prod-info\" style=\"whitespace:nowrap;\">";
									$product_type = $answer -> product -> type;
									switch($product_type){
									case "text":
									$result .= "<span class=\"digiseller-bold\">Товар:</span> текстовая информация (".$answer -> product -> text -> size."&nbsp;символов)<span class=\"digiseller-grey\">, загружен ".$answer -> product -> text -> date."</span><br />\n";
									break;
									
									case "file":
									$result .= "<span class=\"digiseller-bold\">Товар:</span> ".$answer -> product -> file -> name." (".$answer -> product -> file -> size."&nbsp;байт)<span class=\"digiseller-grey\">, загружен ".$answer -> product -> file -> date."</span><br />\n";
									if($answer -> product -> file -> trial != ""){
									$result .= "<span class=\"digiseller-bold\">Демо версия:</span> <span class=\"digiseller-grey\">".$answer -> product -> file -> trial."</span><br />\n";}
									break;}
									
									if(!empty($answer -> product -> release_date)){
									$result .= "<span class=\"digiseller-bold\">Товар:</span> <span class=\"digiseller-grey\">предзаказ (Оплатив предварительный заказ, вы одним из первых получите товар с первых минут официального релиза)</span><br />\n";}
					$result .= "<span class=\"digiseller-bold\">Количество продаж/возвратов:</span> ".$answer -> product -> statistics -> sales."/".$answer -> product -> statistics -> refunds."<br />
							</div>\n";
								
					$result .= "<div class=\"digiseller-prodinfoseparator\">&nbsp;</div></div>\n";
						if(trim($answer -> product -> discounts)){
							$result .= "<div class=\"digiseller-discounttable2\">
							<span >На товар предоставляется скидка постоянным покупателям.</span>
							* Если общая сумма покупок больше чем:
							<ul>";
								foreach($answer -> product -> discounts -> discount as $discount){
								$result .= "<li>".$discount -> summa."\$ - Скидка ".$discount -> percent." %</li>\n";}
								$result .= "</ul>
							</div>
							<span class=\"digiseller-grey\"></span>\n";}
					$result .= "</div>
						</div>
							<span class=\"digiseller-grey\"></span>
							</div>
								<div class=\"digiseller-both\"></div>\n";}}}
							$count_responses = ((int)$answer -> product -> statistics -> good_reviews) + ((int)$answer -> product -> statistics -> bad_reviews);
								if($count_responses > 0){
								$responses_content = "<a id=\"goods_resp_tab\">Отзывы ($count_responses)</a>";}
								else{$responses_content = "";}
							$result .= "<div>
								<div class=\"digiseller-productdetails-tabs\">
									<a id=\"goods_desc_tab\" class=\"digiseller-activeTab\">Описание</a>$responses_content
									
									<div>
										<div class=\"digiseller-description_content\">\n";
										if(trim($answer -> product -> info)){
											$result .= "<div class=\"digiseller-prod-info\">
											".nl2br($answer -> product -> info)."
											</div>\n";}
										if(trim($answer -> product -> add_info) != ""){
											$result .= "<div class=\"digiseller-prod-info\">
											<h3>Дополнительная информация:</h3>
											".nl2br($answer -> product -> add_info)."
											</div>\n";}
							$result .= 	"</div>
										<div class=\"digiseller-reviews_content\" style=\"display:none;\">&nbsp;</div>
									</div>
								</div>
							</div>\n";
							/*
							$result .= "<div id=\"info_resp\">\n";
								if($resp_block = file_get_contents("http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resp_block.php?id_goods=".$answer -> product -> id)){
								$result .= $resp_block;}
							$result .= "</div>\n";
							*/
echo $result;
			?>			
			<!-- end.Список товаров -->
				</div>
<?php }
// функция шаблонизации
tmp_open($tmp_type,$tmp_dir,$tmp_file,$head);
?>