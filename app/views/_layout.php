<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../../public/assets/js/jquery-3.6.2.js"></script>
    <link rel="stylesheet" type="text/css" href="../../public/assets/css/style.css">
	<title>Мой сайт</title>
</head>
<body>
    <header>Мой сайт</header>
    <main>
        <nav><ul>
            <li><a href="/main/index">Главная</a></li>
            <li><a href="/about/index">Обо мне</a></li>	
            <li><a href="/hobbies/index">Мои интересы</a></li>
            <li><a href="/learning/index">Учеба</a></li>
            <li><a href="/photo/index">Фотоальбом</a></li>
            <li><a href="/contact/index">Контакт</a></li>
            <li><a href="/test/index">Тест по дискретной математике</a></li>
            <li><a href="/history/index">История просмотра</a></li>
        </ul></nav>
        <?php include $content_view ?>
    </main>
    <script src="../../public/assets/js/menu_items_handler.js"></script>
    <script src="../../public/assets/js/time.js"></script>
    <script src="../../public/assets/js/history.js"></script>
    <?=$extras ?>
</body>
</html>