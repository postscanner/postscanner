<?php
class User{
	protected $ssid;
	protected $userID = 0;
    protected $login;
	
	protected $table_users;
	
	public function __construct()
	{
		//$this->table_users 			= _DB_PREFIX.'_users';
		if(isset($_COOKIE['sid'])) {
			session_id($_POST['sid']);
		}
        // session_save_path('/home/postsanner/sessions/');
        ini_set('session.cookie_lifetime', 1000000000);
        ini_set('session.gc_maxlifetime', 1000000000);

        // exit();
        session_start();
        $this->fillFieldsFromSession();
	}
	
	private function fillFieldsFromSession(){
		$this->ssid = session_id();
		$this->userID = $_SESSION['user_ID'];
        $this->login = $_SESSION['user_login'];
	}
    
    public function getUserEmail() {
        return $this->login;
    }
	
	public function login($login, $pass){
        global $db;
		if(!empty($login) && !empty($pass)){
            $user = $db->fetch("SELECT * FROM `users` WHERE `email`='".$login."' LIMIT 1");
			if (($user) && md5($pass) == $user->pass)
			{
				// session_start();
				$_SESSION['islogged'] = 'yes';
				$_SESSION['user_ID'] = $user->ID;
				$_SESSION['user_login'] = $user->email;
				
				$this->fillFieldsFromSession();
				
				/*$answer = array(
					'session_id' => $this->ssid,
					'user_ID' => $user['user_ID'],
					'user_login' => $user['user_login'],
					'user_email' => $user['user_email']
				);
							
				return json_encode(array('data' => $answer));*/
                return true;
			}
		}
        return false;
		//return json_encode(array('error' => 'Ошибка авторизации!'));
	}
    public function register() {
        global $db;
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (strlen($email) == 0 || !preg_match("/[-0-9a-z_]+@[-0-9a-z_]+\.[a-z]{2,6}/i", $email)) {
        
            return false;        
        }
        if (strlen($pass) == 0 || !preg_match("/[A-Za-z0-9_]+/i", $pass)) {
            return false;        
        }
        $pass = md5($pass);
        $db->query("INSERT INTO `users` (`ID`, `email`, `pass`) VALUES (NULL, '$email', '$pass');");
        return true;
    }
	public function isLogged(){
		return ($_SESSION['islogged'] == 'yes');
	}
	
	public function logoff(){
		$_SESSION['islogged'] = 'no'; 
		$_SESSION['user_ID'] = 0;
		$_SESSION['user_login'] = '';
		session_destroy();
		$this->fillFieldsFromSession();
		
		return json_encode(array('data' => 'ОК'));
	}
    
    public function isAdmin() {
        return $_SESSION['user_ID'] == 1;
    }
    
    public function isNewsManager() {
        return $_SESSION['user_ID'] == 14;    
    }
	
}
?>
