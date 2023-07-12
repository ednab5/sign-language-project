<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

Flight::route('POST /contact', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::contactUsService()->adding_contact_message($data));
});

Flight::route('GET /contact_us', function () {
    Flight::json(Flight::contactUsService()->get_all());
});





?>
