<?php

namespace App\Logic\Curl;

define('URL_LOGIN', 'https://ibank.bankmandiri.co.id/retail3/loginfo/performLoginExecute');
define('URL_SALDO', 'https://ibank.klikbca.com/balanceinquiry.do');
define('URL_MUTASI_INDEX', 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt');
define('URL_MUTASI_VIEW', 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview');
define('URL_MUTASI_DOWNLOAD', 'https://ibank.klikbca.com/stmtdownload.do?value(actions)=account_statement');
define('URL_RANDOM_NUMBER', 'https://ibank.bankmandiri.co.id/retail3/loginfo/getRandomNumberLogin');
define('USERNAME', 'indrasas0920');
define('PASSWORD', '029029');

use Carbon\Carbon;

class MandiriOnline{
	public $ch = false;
	public $ip = '';
	public $last_html = '';
	public $logged_in = false;
	public $random_number = "";
	public $mod = "B2AD4CAC8EF5113B80B294B16E3C18D22B82A658C3977CBF3DA96988A436C0B778955360E7603B443B19628E45CDFCCD28AD64271EFEFF807B778BDA90F883ED75DDD80FBD6582F918B32C33E641B88B71820BD94294551FAE1906763306EBD8F3FD2601CE284B4242527CA417380C177FA911430DC71C52A6ADBC2FA0DBA3D0FFB5A262FD044A4ED6FB0C511BD1FE8374D03574579002D6F4374D77D25B986D97E961A791BD68C26E2CE5FB2C8BE8E5B247E5FDE5C8F545A7BAD0370A6A33789E1C79657E5581F7706AFF73FFA8811BA2E7A1DB2A8928F265D746FB8E4E165F2E3B08B59E47F64BFE95AF5005A0AB16F18521EC5CA9DF9B0A5BFEDDE577237F";
	public $exp = "00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000003";
	public $data = null;
	//public $password = '029029';
	//public $username = 'indrasas0920';

	public $password = '889889';
	public $username = 'wahyunis8431';

	public function construct__($data){
		$this->data = $data;
	}

	public function setlogin($user, $pass){
		$this->password = $pass;
		$this->username = $user;
	}
 
	function klikbca_by_semprot() {
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->logged_in = false;
	}

	function view_mutasi() {
		if ($this->logged_in == false) {
			//trigger_error('LOGIN FIRST', E_USER_WARNING);
			//return false;
		}
		$res = $this->my_curl_get(URL_MUTASI_VIEW);
		$this->last_html = $res['response'];
		preg_match_all('/color=\"\#0000bb\"\>([ ]+)?([0-9\,]+)/i', $res['response'], $match);
		//echo '<pre>';print_r($match);echo '</pre>';
		return true;
	}

	function random_number(){
		$data = array(
			
		);
		$data = http_build_query($data);

		$res = $this->my_curl_post(URL_RANDOM_NUMBER, $data);
		$this->last_html = $res['response'];
		$prefix = "{\"randomNumber\":\"";
		$prefix_length = strlen($prefix);

		$this->random_number = substr($res['response'], $prefix_length, strlen($res['response'])-2-$prefix_length);
	}


	function login() {
		$this->logged_in = false;

		$data = array(
			'value(userId)'=>$this->data['userId'],
			'value(userPassCrypto)'=>$this->data['userPassCrypto'],
			'value(lang)'=>'in',
			'value(userPass)'=>'',
			'value(exp)'=>$this->exp,
			'value(mod)'=>$this->mod,
			'value(key1)'=>$this->data['key1'],
			'value(key2)'=>$this->data['key2'],
			'value(randomNumber)'=>$this->random_number
		);
		
		//$data = http_build_query($data);
		return $data;
		$res = $this->my_curl_post(URL_LOGIN, $data);

		return $res['response'];
		$this->last_html = $res['response'];
		if (preg_match('/value\(user_id\)/i', $res['response'])) {
			//trigger_error('CAN NOT LOGIN TO KLIKBCA (5 MIN.)', E_USER_WARNING);
			return false;
		}
		$this->logged_in = true;

		return true;
	}

	function my_curl_close() {
		if ($this->ch != false) {
			curl_close($this->ch);
		}
	}

	function my_curl_get($url, $ref = '') {
		if ($this->ch == false) {
			$this->my_curl_open();
		}
		$ssl = false;
		if (preg_match('/^https/i', $url)) {
			$ssl = true;
		}

		if ($ssl) {
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		}

		if ($ref == '') {
			$ref = $url;
		}

		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_REFERER, $ref);
		$res = curl_exec($this->ch);
		$info = curl_getinfo($this->ch);

		return array(
			'response' => trim($res),
			'info' => $info
		);
	}

	function my_curl_open() {
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
		@curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->ch, CURLOPT_MAXREDIRS, 2);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/curl-cookie.txt');
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/curl-cookie.txt');
		curl_setopt($this->ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	}

	function my_curl_post($url, $post_data, $ref = '') {
		if ($this->ch == false) {
			$this->my_curl_open();
		}
		$ssl = false;
		if (preg_match('/^https/i', $url)) {
			$ssl = true;
		}
		if ($ssl) {
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		}
		if ($ref == '') {
			$ref = $url;
		}

		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_REFERER, $ref);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);
		$res = curl_exec($this->ch);
		$info = curl_getinfo($this->ch);

		return array(
			'response' => trim($res),
			'info' => $info
		);
	}
}