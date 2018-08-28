<?php
$config = Config::singleton();
 
$config->set('controllersFolder', 'Controllers/');
$config->set('viewsFolder', 'Views/');

$config->set('app', 'http://localhost/desarrollo/test/index.php');
$config->set('public', 'http://localhost/desarrollo/test/public');

//ENDPOINTS P
$config->set('uri_airlines', 'https://beta.id90travel.com/airlines');
$config->set('uri_auth', 'https://beta.id90travel.com/session.json');
$config->set('uri_hotels', 'https://beta.id90travel.com/api/v1/hotels.json');
?>