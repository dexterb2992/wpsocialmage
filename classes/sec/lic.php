<?php
if( !function_exists('getPageData') ){
	include "../functions.php";
}

class CSNA_lic
{
	public $prefix = "csna_";
	private $message = "";
	private $url = WP_SM_LICENSE_HOST;
	private $fail_safe_message = "We're sorry but communications are temporarily down. Please wait for service to be restored before trying to validate your license key again.";
	public $key = '';
	public $uri = '';
	private $has_expry = false;
	
	function __construct($config)
	{
		if(is_array($config)) {
			if($config['prefix']) $this->prefix = $config['prefix'];
			if($config['url']) $this->url = $config['url'];
			if($config['pl_type']) $this->plType = $config['pl_type'];
		}
		
		$this->opts = array();
		$key = get_option( $this->prefix .'key' );
		$lkey = get_option( $this->prefix .'lkey' );
		if($key) $this->opts['key'] = $key;
		if($lkey) $this->opts['lkey'] = $lkey;
		
		$this->uri = plugin_dir_url(__FILE__);
		$this->valid = false;
	}
	
	private function enc($str)
	{
		$iv = mcrypt_create_iv( mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM );
		return base64_encode( 
			$iv . mcrypt_encrypt(
				MCRYPT_RIJNDAEL_128,
				hash('sha256', $this->key, true),
				$str,
				MCRYPT_MODE_CBC,
				$iv
			)
		);
	}
	private function dec($str)
	{
		$data = base64_decode($str);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		return rtrim(
			mcrypt_decrypt(
				MCRYPT_RIJNDAEL_128,
				hash('sha256', $this->key, true),
				substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
				MCRYPT_MODE_CBC,
				$iv
			),
			"\0"
		);
	}
	
	function isJson($string) {
		if(phpversion() >= '5.3.0') {
			json_decode($string);
			return (json_last_error() == JSON_ERROR_NONE);
		}
		
		$var = @json_decode($string);
		if($var && is_array($var)) 
			return true;
		
		return false;
	}
	
	function check()
	{
		if(count($this->opts)==0 || !isset($this->opts['key']) || !isset($this->opts['lkey'])) return false;
		
		$this->key = $this->opts['key'].$this->plType;
		$opts = $this->dec($this->opts['lkey']);

		$opts = explode(' ', $opts);
		
		if(count($opts)<2 || count($opts)>3) return false;
		
		if(count($opts)==2) return true;
		
		if(count($opts)==3) {
			$this->has_expry = true;
			$this->did_expire = false;
			$this->expdate = $opts[2];
			if(time()>$opts[2]) {
				$this->did_expire = true;
				return false;
			}
			return true;
		}
		
		return false;
	}
	
	function setMessage( $str ) 
	{
		$this->message = $str;
	}
	
	function validate($email, $lic) 
	{
		if(phpversion() < '5.2.0') {
			$this->setMessage("In order for this plugin to work, use PHP with version not lower than <strong>5.3.0</strong>. Used PHP version: " . phpversion());
			return false;
		}
		
		$this->accnt = array('email'=>$email, 'key'=>$lic);
		$form = array(
			'email'      => $email,
			'licensekey' => $lic,
			'domainname' => $_SERVER['HTTP_HOST'],
			'pl_type'    => (isset($this->plType))? $this->plType: 'standard',
			'format'     => 'json',
		);
		
		if( phpversion() < 5.5 ){
			$this->url .= 'email='.urlencode($email).'&licensekey='.urlencode($lic).'&domainname='.$_SERVER['HTTP_HOST'].
				'&pl_type='.urlencode((isset($this->plType))? $this->plType: 'standard').'&format=json';
		}else{
			$this->url .= http_build_query($form, null, '&');
		}
		
		$data = getPageData( $this->url );
		
		if(!$data) {
			if(is_callable('curl_init')) $data = @$this->get_contents( $this->url );
			else {
				$this->setMessage("PHP Curl is not yet enabled in your server.");
				return false;
			}
		}
			
		if(!$data) {
			$this->setMessage($this->fail_safe_message);
			return false;
		}
		
		$data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data);

		if($this->isJson($data)) {
			$data = json_decode($data, true);
			if($data['valid']=='1') {
				$this->expdate = !empty($data['exp'])? strtotime($data['exp']): '';
				return true;
			}else {
				$msg = ($data['message'])? $data['message']: $this->fail_safe_message;
				$this->setMessage($msg);
				return false;
			}
		}
		
		$this->setMessage($this->fail_safe_message);
		return false;
	}
	
	function get_contents( $url )
	{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch); 
		$errmsg = curl_error($ch); 
		curl_close($ch);
		
		if ($errmsg!='') 
			return $errmsg; 
		else 
			return $response;
		
		return '';
	}
	
	function setLic() 
	{
		$code = str_split(base64_encode($this->accnt['key'].date('is')));
		shuffle($code);
		$code = implode($code);

		$this->key = $code.$this->plType;
		$data = $this->accnt['email'] .' '. $this->accnt['key'];
		if($this->expdate) $data .= ' '. $this->expdate;
		$lkey = $this->enc($data);
		
		update_option( $this->prefix .'key', $code );
		update_option( $this->prefix .'lkey', $lkey );
	}
	
	function renderDefaultCss() 
	{
		$prefix = str_replace('_', '-', $this->prefix);
		require('def.css.php');
	}
	
	function renderForm() {
		$prefix = str_replace('_', '-', $this->prefix);
		$message = $this->message;
		
		// $revalidate = (!empty($_GET['revalidate']) && $_GET['revalidate']=='1');
		// if($this->did_expire && !$revalidate) require('exp.php');
		// else require('form.php');
		
		if($this->did_expire) require('exp.php');
		require('form.php');
	}
	
	function renderExpirationBox() {
		if($this->has_expry == false) return false;
		
		$prefix = str_replace('_', '-', $this->prefix);
		require('def.css.exp.php');
		require('expbox.php');
	}
	
	function getExp() {
		return isset($this->expdate)? $this->expdate: '';
		return $this->expdate;
	}

	function get_opts(){
		if(count($this->opts)==0 || !isset($this->opts['key']) || !isset($this->opts['lkey'])) return 'MISSING OR INVALID OPTIONS';
		$this->key = $this->opts['key'].$this->plType;
		pre($this->opts);
		return $this->dec($this->opts['lkey']);
	}
}
?>