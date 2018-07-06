<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class EncryptDecrypt extends Component {

	public function Encrypt($action, $data) {
		$output = false;

		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'perfume';
		$secret_iv = 'perfume123';

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		//do the encyption given text/string/number
		if ($action == 'encrypt') {
			$output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if ($action == 'decrypt') {
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}

}
