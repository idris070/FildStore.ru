function responses(id_goods, type, page){
	$.get("resp_block.php?id_goods=" + id_goods + "&type=" + type + "&page=" + page, function(result){
		if (result.length>10){
			$("#info_resp").html(result);}});
			}

function SubCat(SubID,Url){
	if(SubID > 0){
		if(document.getElementById("sub_" + SubID).style.display == 'none'){
			document.cookie = "sub_" + SubID + '=block';}
		else{
			document.cookie = "sub_" + SubID + '=none';}}
document.location.href = Url;}

$(document).ready(function(){
	$("#goods_resp_tab").click(function(){
		$(this).attr("class","digiseller-activeTab");
				$("#goods_desc_tab").removeAttr("class");
		$(".digiseller-description_content").css("display","none");
		$(".digiseller-reviews_content").css("display","block");});
	$("#goods_desc_tab").click(function(){
		$(this).attr("class","digiseller-activeTab");
		$("#goods_resp_tab").removeAttr("class");
		$(".digiseller-description_content").css("display","block");
		$(".digiseller-reviews_content").css("display","none");});
		
		
});