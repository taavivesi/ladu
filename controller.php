<?php

function controller_add($nimetus, $kogus){

	if( !controller_user() ){
		message_add('Pole sisselogitud!');
		return false;
	}

	if($nimetus == '' || $kogus <= 0){
		message_add('Vigased andmed!');
		return false;
	}

	if (model_add($nimetus, $kogus)) {
        message_add('Lisamine õnnestus!');
        return true;
    }
    message_add('Lisamine ebaõnnestus!');
    return false;
}

function controller_delete($id){

    if (!controller_user()) {
        message_add('Pole sisselogitud!');
        return false;
    }
    if ($id <= 0) {
        message_add('Vigased andmed!');
        return false;
    }
    if (model_delete($id)) {
        message_add('Kustutati rida '.$id);
        return true;
    }
    message_add('Kustutamine ebaõnnestus!');
    return false;
}

function controller_update($id, $kogus){

	if (!controller_user()) {
         message_add('Pole sisselogitud!');
         return false;
     }
     if ($id <= 0 || $kogus <= 0) {
         message_add('Vigased andmed!');
         return false;
     }
     if (model_update($id, $kogus)) {
         message_add('Uuendati andmeid real '.$id);
         return true;
     }
     message_add('Uuendamine ebaõnnestus!');
     return false;
}

function controller_register($kasutajanimi, $parool){

	if ($kasutajanimi == '' || $parool == '') {
			message_add('Vigased andmed!');
			return false;
	}
	if (model_user_add($kasutajanimi, $parool)) {
			message_add('Registreerimine õnnestus!');
			return true;
	}
	message_add('Registreerimine ebaõnnestus, kasutajanimi võib olla juba võetud');
	return false;
}

function controller_user(){
	if( empty($_SESSION['login']) ){
		return false;
	}
	return $_SESSION['login'];
}

function controller_login($kasutajanimi, $parool){

	if ($kasutajanimi == '' || $parool == '') {
			 message_add('Vigased andmed!');

			 return false;
	 }

	 $id = model_user_get($kasutajanimi, $parool);
	 if (!$id) {

			 message_add('Kasutajanimi või parool on vigane!');

			 return false;
	 }

	 session_regenerate_id(); 
	 $_SESSION['login'] = $id;

	 message_add('Oled nüüd sisse logitud!');

	 return $id;
}

function controller_logout() {

	if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 42000, '/');
	}

	$_SESSION = array();

	session_destroy();
	message_add('Oled nüüd välja logitud!');
	return true;

}

function message_add($message) {

	if(empty($_SESSION['messages'])) {
		$_SESSION['messages'] = array();
	}
	$_SESSION['messages'][] = $message;
}

function message_list() {

    if (empty($_SESSION['messages'])) {
        return array();
    }
    $messages = $_SESSION['messages'];
    $_SESSION['messages'] = array();

    return $messages;
}
