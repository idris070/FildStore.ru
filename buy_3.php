<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <form id=payment-method-form name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251" >
						<h3>Выберите способ оплаты</h3>
						<fieldset class='payment-method-list'>
							<ul>
<?php
  if ($_GET[value]==WMR) {
    echo "<li class='payment-method-webmoney clearfix'>
        <input id='info_cost' type='hidden' name='LMI_PAYMENT_AMOUNT' value='$id[cost]' readonly>
        <input id='info_name' type='hidden' name='LMI_PAYMENT_DESC' value='$id[name]'>
        <input type='hidden' name='LMI_PAYMENT_NO' value='1'>
        <input type='hidden' name='LMI_PAYEE_PURSE' value='R979044146189' >
        <input type='hidden' name='LMI_SIM_MODE' value='0' >
        <input id='info_id' type='hidden' name='id' value='$_GET[id]' >
        <input id='info_buy_login' type='hidden' name='buy_login' value='$_SESSION[login]' >
				<p><b>Webmoney. </b>Оплата через стандартный Webmoney Transfer или выписку счёта на ваш WMID. Учитывайте комиссию Webmoney за перевод - 0.8%.</p>
			</li>";
  }
  if ($_GET[value]==QSR) {
  echo "<li class='payment-method-qiwi clearfix'>
      <p><b>QIWI. </b>Через платёжный сервис Robokassa на ваш номер в системе QIWI будет выписан счёт, который будет необходимо оплатить в Личном Кабинете QIWI.</p>
    </li>";
  }
  if ($_GET[value]==PCR) {
  echo "  <li class='payment-method-yandex clearfix'>
      <p><b>Яндекс.Деньги. </b>Через платёжный сервис Robokassa вы будете перенаправлены на оплату на сайте Яндекс.деньги.</p>
    </li>";
  }
  if ($_GET[value]==RCC) {
  echo "<li class='payment-method-visa clearfix'>
      <p><b>VISA. </b>Оплата банковскими картами осуществляется на стороне платёжного сервиса Robokassa и Платёж.ру </p>
    </li>";
  }
?>
                <li>
            <center><button onclick=buy_2() type="button" class="btn" name="action" value="buy">Назад</button>
            <button onclick=buy_4() type="button" class="btn" name="action" value="buy">Купить</button></center>
                </li>
							</ul>
						</fieldset>
						</form>

  </body>
  <style media="screen">
  #payment-method-form{}
  #payment-method-form h3{font-size:12px;text-align:center;text-transform:uppercase;font-weight:bold;margin-top:12px;margin-bottom:30px;}
  #payment-method-form fieldset{}
  .payment-method-list{padding:0 40px 40px 30px;margin:0;border:none;background:url(../img/order-header-shadow.png) no-repeat bottom center;}
  .payment-method-list ul{}
  .payment-method-list li{margin-bottom:20px;}
  .payment-method-list input[type="radio"]{float:left;margin-top:9px;cursor:pointer;}
  .payment-method-list li p{margin-left:72px;border-bottom:1px solid #cccccc;padding-bottom:20px;margin-bottom:0;}
  .payment-method-webmoney{background:url(http://steambuy.com/template/img/payment-method/webmoney.png) no-repeat 28px 0px;}
  .payment-method-qiwi{background:url(http://steambuy.com/template/img/payment-method/qiwi.png) no-repeat 28px 0px;}
  .payment-method-yandex{background:url(http://steambuy.com/template/img/payment-method/yandex.png) no-repeat 28px 0px;}
  .payment-method-visa{background:url(http://steambuy.com/template/img/payment-method/visa.png) no-repeat 26px 9px;}

  </style>
</html>
