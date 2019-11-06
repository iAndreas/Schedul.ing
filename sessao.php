<?php

class GerenciadorSessao {

	public static function startSession() {
		try{
			if(session_status() !== PHP_SESSION_ACTIVE) 
				session_start();
		} catch (Exception $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}

	public static function isLoggedIn() {
		self::startSession();
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
			return false;
		}
		return true;
	}

	public static function logIn($user) {
		self::startSession();
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_name'] = $user['usuario'];
		$_SESSION['logged_user'] = $user['nome'];
		header('Location: index.php');
	}

	public static function logout() {
		// inicia a sessão
		self::startSession();
		
		// muda o valor de logged_in para false
		$_SESSION['logged_in'] = false;
		
		// finaliza a sessão
		session_destroy();

		header('Location: index.php');
	}

	public static function getLoggedUser() {
		self::startSession();
		return $_SESSION['user_id'];
	}

}







?>