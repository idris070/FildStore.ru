<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ajax + Kohana 3.3.0</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>
		$(document).ready(function(){
			$("#sendAjax").click(function(){ // при нажатии кнопки добавления новой статьи
				$("#sendAjax").attr('disabled','disabled'); // делаем кнопку недоступной, чтобы избежать повторных нажатий
				$("#error").slideUp('slow'); // убираем блок с ошибкой, если он был
				$("#loading").slideDown('slow'); // показываем индикатор загрузки
				var name = $('#name').val(); // берем имя статьи из формы
				var text = $('#text').val(); // берем текст из формы
				$.ajax({ // описываем наш запрос
						type: "POST", // будем передавать данные через POST
						dataType: "json", // указываем, что нам вернется JSON
						url: "/ajax/addarticle", // запрос отправляем на контроллер Ajax метод addarticle
						data: "name="+name+"&text="+text, // передаем данные из формы
						success: function(response) { // когда получаем ответ
							if (response.code == 'error') // если вернулся статус с ошибкой
							{
								$("#error").slideDown('slow'); // показываем блок с сообщением об ошибке
							}
							if (response.code == 'success') // если вернулся статус успешного добавления статьи в БД
							{
								$("#articles").load('/ajax/getarticles'); // обновляем список статей
							}
							$("#sendAjax").removeAttr('disabled'); // делаем кнопку снова доступной
							$("#loading").slideUp('slow'); // убираем индикатор загрузки
						}
				});
			});
		});
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0;">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet">
</head>
	<body>
		<div id="wrap">
			<div class="push"></div>
			<div class="container"> 
				<div class="page-header">
				  <h1><a href="/">Ajax + Kohana 3.3.0</a> <small>ruslan.cc</small></h1>
				</div>				
			</div>
			<div class="container"> 
				<div id="articles"><?=$articles;?></div>
                <hr>
                <div id="addarticle"><?=$addarticle;?></div>		
			</div>
		</div>
	</body>
</html>