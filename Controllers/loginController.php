<?php
class loginController{

	protected $view;
	protected $httpClient;
    protected $config;

    function __construct(){
        $this->view = new View();
        $this->httpClient = new GuzzleHttp\Client();
        $this->config = Config::singleton();
    }


    public function login(){
    	$airlines = [];
    	$airlines =  $this->getArlines();
      	$this->view->getView("login/loginView.php",$airlines);
    }

     public function logout(){
    	session_start();
		session_destroy();
      	$this->login();
    }


    public function getArlines(){
		$response = $this->httpClient->request('GET', $this->config->get('uri_airlines'));
		return ['airlines' => json_decode($response->getBody()->getContents())]; 
	}



	public function checkLogin(){
		$request = [];
		if (!isset($_POST['session'])) {
			$this->login();
		}else{
			$request = $_POST;
		}


		try {
		$response = $this->httpClient->request('POST',  $this->config->get('uri_auth'),
			    array(
			        'form_params' => $request
		    	)
		);
		} catch (Exception $e) {
			$this->view->getView("errorView.php");
			return;
		}

		$resp = json_decode($response->getBody()->getContents());


		if ($resp->redirect == 'https://beta.id90travel.com/') {
			session_start();
			$_SESSION['login']='true';
			$this->view->getView("hotel/searchHotelView.php");
		}else{
			$this->login();
		}


	}
}
