<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$vars = [
			'tariffs' => $this->tariffs,
		];
		$this->view->render('Главная страница', $vars);
	}

	public function localeAction() {

		define('localhost', realpath(dirname(__FILE__)));
define('ru_RU', localhost . '/application/langs');
		 
		           // Задаем текущий язык проекта
				   putenv("LANG=ru_RU");

				   // Задаем текущую локаль (кодировку)
				   setlocale (LC_MESSAGES,"ru_RU");
		
				   // Указываем имя домена
				   $locale = 'localhost';
		
				   // Задаем каталог домена, где содержатся переводы
				   bindtextdomain ($locale, './application/langs/');
		
				   // Выбираем домен для работы
				   textdomain ($locale);
		
				   // Если необходимо, принудительно указываем кодировку (эта строка не
				   // обязательна, она нужна, если вы хотите выводить текст в отличной от
				   // текущей локали кодировке).
		
				   bind_textdomain_codeset($locale, 'UTF-8');
		
		//$this->view->render('Главная страница');
	}


}