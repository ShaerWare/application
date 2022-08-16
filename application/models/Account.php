<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

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
			'family' => [
				'pattern' => '#^[йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХЪЭЖДЛОРПАВЫФЯЧСМИТЬБЮёЁa-zA-Z]{1,20}+$#',
				'message' => 'Имя указано неверно, введите от 2 до 20 букв',
			],
			'name' => [
				'pattern' => '#^[йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХЪЭЖДЛОРПАВЫФЯЧСМИТЬБЮёЁa-zA-Z]{1,20}+$#',
				'message' => 'Имя указано неверно, введите от 2 до 20 букв',
			],
			'name2' => [
				'pattern' => '#^[йцукенгшщзхъэждлорпавыфячсмитьбюЙЦУКЕНГШЩЗХЪЭЖДЛОРПАВЫФЯЧСМИТЬБЮёЁa-zA-Z]{1,20}+$#',
				'message' => 'Имя указано неверно, введите от 2 до 20 букв',
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

	public function register($post) {
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
			'family' => $post['family'],
			'name' => $post['name'],
			'name2' => $post['name2'],
			'email' => $post['email'],
			'tel' => 0,
			'ser' => $post['ser'],
			'nomer' => $post['nomer'],
			'data' => $post['data1'],
			'vidan' => $post['vidan'],
			'kod' => $post['kod'],
			'login' => $post['login'],
			'wallet' => $post['wallet'],
			'password' => password_hash($post['password'], PASSWORD_BCRYPT),
			'ref' => $ref,
			'refBalance' => 0,
			'token' => $token,
			'status' => 0,
		];
		//debug($params);
		$this->db->query('INSERT INTO accounts (id, agent, family, name, name2, tel, ser, nomer, data, vidan, kod, email, login, wallet, password, ref, refBalance, token, status) VALUES (:id, :agent, :family, :name, :name2, :tel, :ser, :nomer, :data, :vidan, :kod, :email, :login, :wallet, :password, :ref, :refBalance, :token, :status)', $params);
		mail($post['email'], 'Register', 'Подтвердите регистрацию: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/confirm/'.$token);
	}

	public function checkData($login, $password) {
		$params = [
			'login' => $login,
		];
		$hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
		if (!$hash or !password_verify($password, $hash)) {
			return false;
		}
		return true;
	}
 
	public function checkStatus($type, $data) {
		$params = [
			$type => $data,
		];
		$status = $this->db->column('SELECT status FROM accounts WHERE '.$type.' = :'.$type, $params);
		if ($status != 1) {
			$this->error = 'Аккаунт ожидает подтверждения по E-mail';
			return false;
		}
		return true;
	}

	public function login($login) {
		$params = [
			'login' => $login,
		];
		$data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
		$_SESSION['account'] = $data[0];
	}

	public function recovery($post) {
		$token = $this->createToken();
		$params = [
			'email' => $post['email'],
			'token' => $token,
		];
		$this->db->query('UPDATE accounts SET token = :token WHERE email = :email', $params);
		mail($post['email'], 'Recovery', 'Confirm: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/reset/'.$token);
	}

	public function reset($token) {
		$new_password = $this->createToken();
		$params = [
			'token' => $token,
			'password' => password_hash($new_password, PASSWORD_BCRYPT),
		];
		$this->db->query('UPDATE accounts SET status = 1, token = "", password = :password WHERE token = :token', $params);
		return $new_password;
	}

	public function save($post) {
		$params = [
			'id' => $_SESSION['account']['id'],
			'agent' => $post['agent'],
			'email' => $post['email'],
			'wallet' => $post['wallet'],
			'family' => $post['family'],
			'name' => $post['name'],
			'name2' => $post['name2'],
			'tel' => 0,
			'ser' => $post['ser'],
			'nomer' => $post['nomer'],
			'data' => $post['data1'],
			'vidan' => $post['vidan'],
			'kod' => $post['kod'],
		];
		if (!empty($post['password'])) {
			$params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
			$sql = ',password = :password,';
		}
		else {
			$sql = '';
		}
		if (!empty($post['agent'])) {
			$params['agent'] = $post['agent'];
			$zog = ', agent = :agent';
		}
		else {
			$zog = '';
		}
		foreach ($params as $key => $val) {
			$_SESSION['account'][$key] = $val;
		}
		$this->db->query('UPDATE accounts SET email = :email, family = :family, name = :name, name2 = :name2, tel = :tel,ser = :ser, nomer = :nomer, data = :data, vidan = :vidan, kod = :kod, wallet = :wallet'.$sql.''.$zog.' WHERE id = :id', $params);
	}
 
}