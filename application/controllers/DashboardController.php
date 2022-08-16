<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class DashboardController extends Controller {

	public function investAction() {
		$vars = [
			'tariff' => $this->tariffs[$this->route['id']],
		];
		$this->view->render('Инвестировать', $vars);
	}

	public function tariffsAction() {
		$pagination = new Pagination($this->route, $this->model->tariffsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->tariffsList($this->route),
		];
		$this->view->render('Тарифы', $vars);
	}

	public function historyAction() {
		$pagination = new Pagination($this->route, $this->model->historyCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->historyList($this->route),
		];
		$this->view->render('История', $vars);
	}

	public function referralsAction() {
		if (!empty($_POST)) {
			if ($_SESSION['account']['refBalance'] <= 0) {
				$this->view->message('success', 'Реферальный баланс пуст');
			}
			$this->model->creatRefWithdraw();
			$this->view->message('success', 'Заявка на вывод создана');
		}
		$pagination = new Pagination($this->route, $this->model->referralsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->referralsList($this->route),
		];
		$this->view->render('Рефералы', $vars);
	}

	public function swiftAction() {
		$pagination = new Pagination($this->route, $this->model->accountsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->accountsList($this->route),
		];
		$this->view->render('Зарегистрированные', $vars);
	}

	//регистрация агентом

	public function regAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['email', 'wallet'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->checkEmailExists($_POST['email']);
			if ($id and $id != $_SESSION['account']['id']) {
				$this->view->message('error', 'Этот E-mail уже используется');
			}
			if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->reg($_POST);
			$this->view->message('success', 'Регистрация завершена, надо подтвердить E-mail');
			//$this->view->message('error', 'Сохранено');
		}
		$this->view->render('Регистрация агентом');
  
	}

	//подтверждение регистрации 

	public function confirmAction() {
		if (!$this->model->checkTokenExists($this->route['token'])) {
			$this->view->redirect('dashboard/login');
		}
		$this->model->activate($this->route['token']);
		$this->view->render('Ваш аккаунт активирован, не забудьте сменить пароль');
	}

}