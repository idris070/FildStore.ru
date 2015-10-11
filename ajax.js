function del (img,id) {
  if (confirm("Вы уверены")){
    var xml = new XMLHttpRequest();
    xml.open('GET','ajax.php?action=del_img&img='+img+'&id='+id,true);
    xml.onreadystatechange=function() {
      if (xml.readyState==4 && xml.status==200) {
        document.getElementById(img).innerHTML = xml.responseText;
      }
    }
    xml.send(null);

  }
}
if (window.location.pathname=="/buy.php"){
function buy_4 () {
  document.getElementById('info_id').value = id
  document.getElementById('info_name').value = name
  document.getElementById('info_cost').value = cost
  document.getElementById('info_buy_login').value = buy_login
  document.getElementById('payment-method-form').submit()
}

  function buy_2 () {
    if (buy_login){
      var xml = new XMLHttpRequest();
      xml.open("GET",'ajax.php?action=buy_2',true);
      xml.onreadystatechange=function() {
        if (xml.readyState==4 && xml.status==200) {
          document.getElementById('content').innerHTML = xml.responseText;
          scrollTo(0,200);
        }
      }
      xml.send(null);
    }
    else alert("Необходимо авторизоваться");
  }
  function buy_3 () {
    var id = document.getElementById("payment-method-form");
    var id_input = id.getElementsByTagName("input");
    for (var i=0; i<id_input.length; i++){
      var input = id_input[i];
      if (input.checked) {
        var pay = true;
        var xml = new XMLHttpRequest();
        xml.open('GET','ajax.php?action=buy_3&value='+input.value,true);
        xml.onreadystatechange=function() {
          if (xml.readyState==4 && xml.status==200) {
            document.getElementById('content').innerHTML = xml.responseText;
            document.getElementById('info_id').value = info["id"].value
            document.getElementById('info_name').value = info["name"].value
            document.getElementById('info_cost').value = info["cost"].value
            document.getElementById('info_buy_login').value = info["buy_login"].value
          }
        }
        xml.send(null);
      }
    }
    if (!pay) {
      alert ("Выберите способ оплаты");
    }
  }
}