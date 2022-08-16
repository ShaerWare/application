<?php

namespace application\models;

use application\core\Model;

class Dashboard extends Model {

	
	public function historyCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM history WHERE uid = :uid', $params);
	}

	public function historyList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT * FROM history WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function referralsCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM accounts WHERE ref = :uid', $params);
	}

	public function referralsList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT login, email FROM accounts WHERE ref = :uid ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function tariffsCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM tariffs WHERE uid = :uid', $params);
	}

	public function tariffsList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->row('SELECT * FROM tariffs WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function creatRefWithdraw() {
		$amount = $_SESSION['account']['refBalance'];
		$_SESSION['account']['refBalance'] = 0;
		
		$params = [
			'id' => $_SESSION['account']['id'],
		];
		$this->db->query('UPDATE accounts SET refBalance = 0 WHERE id = :id', $params);

		$params = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'amount' => $amount,
		];
		$this->db->query('INSERT INTO ref_withdraw VALUES (:id, :uid, :unixTime, :amount)', $params);

		$params = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'description' => 'Вывод реферального вознаграждения, сумма '.$amount.' $',
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
	}
	
	//добавляем пользователей агентом

	public function validate($input, $post) {
		$rules = [
			'email' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'E-mail адрес указан неверно',
			],
			'login' => [
				'pattern' => '#^[йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХЪЭЖДЛОРПАВЫФЯЧСМИТЬБЮёЁa-zA-Z0-9]{3,15}$#',
				'message' => 'Логин указан неверно (разрешены только кирилические и латинские буквы (и цифры) от 3 до 15 символов)',
			],
			'ref' => [
				'pattern' => '#^[a-z0-9]{3,15}$#',
				'message' => 'Логин пригласившего указан неверно',
			],
			'wallet' => [
				'pattern' => '#^[0-9+]{10,12}$#',
				'message' => 'Телефон указан неверно, введите от 10 до 11 цифр',
			],
			'password' => [
				'pattern' => '#^[йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХЪЭЖДЛОРПАВЫФЯЧСМИТЬБЮёЁa-z0-9+-@!_<>|\/ ]{10,30}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов и пиктограммы типа +-@!_<>|\/',
			],	
			
		];
		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		if (isset($post['ref'])) {
			if ($post['login'] == $post['ref']) {
				$this->error = 'Регистрация невозможна';
				return false;
			}
		}
		return true;
	}

	public function checkEmailExists($email) {
		$params = [
			'email' => $email,
		];
		return $this->db->column('SELECT id FROM accounts WHERE email = :email', $params);
	}

	public function checkLoginExists($login) {
		$params = [
			'login' => $login,
		];
		if ($this->db->column('SELECT id FROM accounts WHERE login = :login', $params)) {
			$this->error = 'Этот логин уже используется';
			return false;
		}
		return true;
	}

	public function checkTokenExists($token) {
		$params = [
			'token' => $token,
		];
		return $this->db->column('SELECT id FROM accounts WHERE token = :token', $params);
	}

	public function activate($token) {
		$params = [
			'token' => $token,
		];
		$this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
	}

	public function checkRefExists($login) {
		$params = [
			'login' => $login,
		];
		return $this->db->column('SELECT id FROM accounts WHERE login = :login', $params);
	}

	public function createToken() {
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
	}

	public function accountsList($route) {
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		$arr = [];
		$result = $this->db->row('SELECT * FROM accounts ORDER BY id DESC LIMIT :start, :max', $params);
		if (!empty($result)) {
			foreach ($result as $key => $val) {
				$arr[$key] = $val;
				$params = [
					'id' => $val['id'],
				];
				$account = $this->db->row('SELECT login, email FROM accounts WHERE id = :id', $params)[0];
				$arr[$key]['login'] = $account['login'];
				$arr[$key]['email'] = $account['email'];
			}
		}
		//debug($arr);
		return $arr;
	}

	public function accountsCount() {
		return $this->db->column('SELECT COUNT(email) FROM accounts');
	}
	
	public function reg($post) {

		$wr = $_SESSION['account'];

		$token = $this->createToken();
		if ($post['ref'] == 'none') {
			$ref = 0;
		}
		else {
			$ref = $this->checkRefExists($post['ref']);
			if (!$ref) {
				$ref = 0;
			}
		}
		 
		$params = [
			'id' => '',
			'agent' => 5,
			'email' => $post['email'],
			'tel' => $_SESSION['account']['id'],
			'login' => $post['login'],
			'wallet' => $post['wallet'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT),
			'token' => $token,
			'status' => 0,
		];
		 
		foreach ($params as $key => $val) {
			$_SESSION['account'][$key] = $val;
		}
		$this->db->query('INSERT INTO accounts (id, agent, tel, email, login, wallet, password, token, status) VALUES (:id, :agent, :tel, :email, :login, :wallet, :password, :token, :status)', $params);
		mail($post['email'], 'Register', 'логин: ' .$post['login']. ' пароль: ' .$post['password']. ' Подтвердите регистрацию и ОБЯЗАТЕЛЬНО смените пароль: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/dashboard/confirm/'.$token);
		 
		$_SESSION['account'] = $wr;

	}

}