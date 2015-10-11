<?php
require_once "./config.php";
require_once $inc_path."functions.php";


$tmp_type = "php";
$tmp_file = "0.tmp";
?>
<?php
session_start();
// проверка агентского ID
get_agent_id();
// заголовок страницы
$head["title"] = "PSN";
// функция вывода контента

function show_content() {
if (!$active_button) {
	include ('bd.php');
	$strSQL = "SELECT * FROM tovar";
	$rs = mysql_query($strSQL);


		echo "<table width=100%><tbody font-size=55px>
			<tr class=room_1>
				<td class=sel>Название товара</td>
				<td class=sel>Цена</td>
				<td class=sel>Продавец</td></tr>";

		while($row = mysql_fetch_array($rs)) {
			// проверка на кол-во
			$res = mysql_query("SELECT COUNT(*) FROM tovar_num WHERE id_tovar=$row[id]");
			$row_num = mysql_fetch_row($res);
			$num_tovar = $row_num[0]; // всего записей
			if($row_num[0]>0){
			echo "<tr class=room_2>
			<td class=sel><a href=buy.php?id=$row[0]>$row[1]</a></td>
			<td class=sel>$row[2]</td>
			<td class=sel>$row[login]</td></tr>";}}}
	?>
				</table>
	<?}
// функция шаблонизации
tmp_open("php", $tmp_dir, $tmp_file, $head);
?>
