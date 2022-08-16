<?php
define('localhost', realpath(dirname(__FILE__)));
define('ru_RU', localhost . '/application/langs');
/* 

if (isset($_POST['locale'])){
    $locale = $_POST['locale'];
}
else    {
    $locale = 'ru_RU';
        }
$_SESSION['locale'] = $locale;
//$locale = $_SESSION['locale'];
//$locale = 'ru_RU';
//$locale = 'en_US';
 
putenv("LC_ALL=" . $locale);
setlocale(LC_ALL, $locale, $locale . '.utf8');
bind_textdomain_codeset($locale, 'UTF-8');
bindtextdomain($locale, LANGUAGES_PATH);
textdomain($locale);*/

           // Задаем текущий язык проекта
           putenv("LANG=ru_RU");

           // Задаем текущую локаль (кодировку)
           setlocale (LC_MESSAGES,"ru_RU");

           // Указываем имя домена
           $locale = 'localhost';

           // Задаем каталог домена, где содержатся переводы
           bindtextdomain ($locale, './application/langs');

           // Выбираем домен для работы
           textdomain ($locale);

           // Если необходимо, принудительно указываем кодировку (эта строка не
           // обязательна, она нужна, если вы хотите выводить текст в отличной от
           // текущей локали кодировке).

           bind_textdomain_codeset($locale, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="ru_RU">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/public/styles/main.css" rel="stylesheet">
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
        <script src="/public/scripts/js.js"></script>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">Сайт</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                                <a class="nav-link" href=""><?php echo _('Preimuchestva')?></a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href=""><?php echo _('Otzivs')?></a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href=""><?php echo _('Product')?></a>
                        </li>
                    </ul>
                    
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php if (isset($_SESSION['account']['id'])): ?>
                        <?php if ($_SESSION['account']['agent'] == 2): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/reg">Создать учетные записи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/swift">Смотреть учетные записи</a>
                            </li>
                        <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/tariffs">Счета</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/referrals">Рефералы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard/history">История</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/profile">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/logout">Выход</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/register">Регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/account/login">Вход</a>
                            </li>
                        <?php endif; ?>
                            <li class="nav-item">
                                <form action="" method="POST">
                                    <select  type="text">
                                        <option name="locale" value="ru_RU" >Ru</option>
                                        <option name="locale" value="en_EN" >En</option>
                                    </select>
                                    <button type="submit">SEND</button>
                                </form>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="">RU</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">EN</a>
                            </li>-->
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
        <br>
        <?php print_r($locale); ?>
        <br>
         
    </body>
</html>