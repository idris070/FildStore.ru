<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form id="payment-method-form" method="POST">
      <input type="hidden" name="id" value="">
      <input type="hidden" name="name" value="">
      <input type="hidden" name="cost" value="">
      <input type="hidden" name="buy_login" value="">
						<h3>Выберите способ оплаты</h3>
						<fieldset class="payment-method-list">
							<ul>
								<li class="payment-method-webmoney clearfix">
									<input type="radio" value="WMR" name="curr">
									<p><b>Webmoney. </b>Оплата через стандартный Webmoney Transfer или выписку счёта на ваш WMID. Учитывайте комиссию Webmoney за перевод - 0.8%.</p>
								</li>
								<li class="payment-method-qiwi clearfix">
									<input type="radio" value="QSR" name="curr">
									<p><b>QIWI. </b>Через платёжный сервис Robokassa на ваш номер в системе QIWI будет выписан счёт, который будет необходимо оплатить в Личном Кабинете QIWI.</p>
								</li>
								<li class="payment-method-yandex clearfix">
									<input type="radio" value="PCR" name="curr">
									<p><b>Яндекс.Деньги. </b>Через платёжный сервис Robokassa вы будете перенаправлены на оплату на сайте Яндекс.деньги.</p>
								</li>
								<li class="payment-method-visa clearfix">
									<input type="radio" value="RCC" name="curr">
									<p><b>VISA. </b>Оплата банковскими картами осуществляется на стороне платёжного сервиса Robokassa и Платёж.ру </p>
								</li>
                <li>
            <center><button onclick=document.location.href = "buy.php?id="+id type="button" class="btn">Назад</button><button onclick=buy_3() type="button" class="btn" name="action" value="buy">Далее</button></center>
                </li>
							</ul>
						</fieldset>
						</form>
						<div style="margin: 30px;text-align: justify;color:red;">
						Уважаемые покупатели, в выдаваемом после оплаты товаре <b>ИСКЛЮЧЕНЫ</b> ошибки.
						Если у вас что-то не получается - просто перечитайте описание и инструкции к товару. Если не можете разобраться самостоятельно
						 - обратитесь в <a href="support">техническую поддержку магазина</a>. Спасибо за внимание!<br>
						</div>
<style media="screen">
.payment-method-webmoney{background:url(http://steambuy.com/template/img/payment-method/webmoney.png) no-repeat 28px 0px;}
#payment-method-form{}
#payment-method-form h3{font-size:12px;text-align:center;text-transform:uppercase;font-weight:bold;margin-top:12px;margin-bottom:30px;}
#payment-method-form fieldset{}
.payment-method-list{padding:0 40px 40px 30px;margin:0;border:none;background:url(../img/order-header-shadow.png) no-repeat bottom center;}
.payment-method-list ul{}
.payment-method-list li{margin-bottom:20px;}
.payment-method-list input[type="radio"]{float:left;margin-top:9px;cursor:pointer;}
.payment-method-list li p{margin-left:72px;border-bottom:1px solid #cccccc;padding-bottom:20px;margin-bottom:0;}
.payment-method-terminal{background:url(http://steambuy.com/template/img/payment-method/terminal.png) no-repeat 28px 0px;}
.payment-method-qiwi{background:url(http://steambuy.com/template/img/payment-method/qiwi.png) no-repeat 28px 0px;}
.payment-method-yandex{background:url(http://steambuy.com/template/img/payment-method/yandex.png) no-repeat 28px 0px;}
.payment-method-visa{background:url(http://steambuy.com/template/img/payment-method/visa.png) no-repeat 26px 9px;}
.payment-method-mastercard{background:url(http://steambuy.com/template/img/payment-method/mastercard.png) no-repeat 30px 6px;}
.payment-method-alpha{background:url(http://steambuy.com/template/img/payment-method/alpha.png) no-repeat 34px 0px;}
.payment-method-sber{background:url(http://steambuy.com/template/img/payment-method/sber.png) no-repeat 34px 0px;}
.payment-method-russt{background:url(http://steambuy.com/template/img/payment-method/russt.png) no-repeat 34px 0px;}
.payment-method-vtb24{background:url(http://steambuy.com/template/img/payment-method/vtb24.png) no-repeat 34px 0px;}
.payment-method-prmsvz{background:url(http://steambuy.com/template/img/payment-method/prmsvz.png) no-repeat 34px 0px;}
.payment-method-svyzn{background:url(http://steambuy.com/template/img/payment-method/svzn.png) no-repeat 34px 0px;}
.payment-method-mts{background:url(http://steambuy.com/template/img/payment-method/mts.png) no-repeat 31px 0px;}
.payment-method-megafon{background:url(http://steambuy.com/template/img/payment-method/megafon.png) no-repeat 28px 0px;}
.payment-method-beeline{background:url(http://steambuy.com/template/img/payment-method/beeline.png) no-repeat 29px 0px;}
.payment-method-tele2{background:url(http://steambuy.com/template/img/payment-method/tele2.png) no-repeat 17px 1px;}
.payment-method-post{background:url(http://steambuy.com/template/img/payment-method/post.png) no-repeat 28px 0px;}
.payment-method-hz{background:url(http://steambuy.com/template/img/payment-method/hz.png) no-repeat 23px 3px;}
.payment-method-z-payment{background:url(http://steambuy.com/template/img/payment-method/z-payment.png) no-repeat 29px 0px;}
.payment-method-iii{background:url(http://steambuy.com/template/img/payment-method/iii.png) no-repeat 28px 0px;}
.payment-method-contact{background:url(http://steambuy.com/template/img/payment-method/contact.png) no-repeat 25px 5px;}
.payment-method-easy-pay{background:url(http://steambuy.com/template/img/payment-method/easy-pay.png) no-repeat 25px 5px;}
.payment-method-vtb{background:url(http://steambuy.com/template/img/payment-method/vtb.png) no-repeat 25px 8px;}
.payment-method-euroset{background:url(http://steambuy.com/template/img/payment-method/euroset.png) no-repeat 25px 0px;}
.payment-method-svyaznoy{background:url(http://steambuy.com/template/img/payment-method/svyaznoy.png) no-repeat 22px 10px;}
</style>
  </body>
</html>
