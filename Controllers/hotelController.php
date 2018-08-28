<?php

class hotelController{

	protected $view;
	protected $httpClient;
	protected $config;
    
    function __construct(){
        $this->view = new View();
        $this->httpClient = new GuzzleHttp\Client();
	 	$this->config = Config::singleton();
    }

    public function searchHotel(){
        $hotels = [];

        try {
            $response = $this->httpClient->request('GET', $this->config->get('uri_hotels'),[
                  'headers'  => ['Content-Type' => 'application/json'],
                  'query' => [
                     'guests[]' => ($_REQUEST['guests'] == '') ? null : $_REQUEST['guests'],
                     'checkin'=>  ($_REQUEST['checkin'] == '') ? null : $_REQUEST['checkin'],
                     'checkout'=>  ($_REQUEST['checkout'] == '') ? null : $_REQUEST['checkout'],
                     'destination'=>  ($_REQUEST['destination'] == '') ? null : $_REQUEST['destination'],
                     'page'=>  ($_REQUEST['page'] == '') ? null : $_REQUEST['page'],
                     'sort_criteria'=>  ($_REQUEST['sort_criteria'] == '') ? null : $_REQUEST['sort_criteria'],
                 ]
            ]);
        } 
        catch (Exception $e) {
            $this->view->getView("errorView.php");
        }
   

        $o_hotel = json_decode($response->getBody()->getContents());

        if (count($o_hotel)>0) {
            $hotels = array('hotels' => $o_hotel->hotels,
                            'meta' => $o_hotel->meta
                      );
        }else{
        	$hotels = ['hotels' => []];
        }
		$this->view->getView("hotel/searchHotelView.php",$hotels);
    }

    
  
}
