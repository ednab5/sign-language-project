<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__.'/../vendor/autoload.php';

Flight::route('/*',function(){
    //perform JWT decode
    $path = Flight::request()->url;
    
    if( $path == '/login' 
    || $path == '/register' 
    || $path == '/docs.json' 
    || $path == '/verifyemail' 
    || $path == '/verify2fa' 
    || $path == '/qr'
    || $path == '/sms' 
    || $path == '/verify2faSMS'  
    || $path == '/resetpassswordemail' 
    || $path == '/resetpassword' 
    || $path != '/rest/lessons' 
          ) return TRUE;   //exclude login route from middleware
    $headers = getallheaders();
    if(@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"],403);
      return FALSE;
    }else {
      try {
        $decoded = (array)JWT::decode($headers['Authorization'],new Key('ezcb9s8UcF','HS256'));
        Flight::set('user',$decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"],403);
        return FALSE;
      }
  
    }
    print_r($headers);
  });
  


require_once __DIR__.'/service/UserService.class.php';
require_once __DIR__.'/service/LessonService.class.php';
require_once __DIR__.'/service/LevelService.class.php';
require_once __DIR__.'/service/ContactUsService.class.php';
require_once __DIR__.'/dao/UserDao.class.php';
require_once __DIR__.'/dao/LessonDao.class.php';
require_once __DIR__.'/dao/LevelDao.class.php';
require_once __DIR__.'/dao/ContactUsDao.class.php';
Flight::register('userDao','UserDao');
Flight::register('lessonDao','LessonDao');
Flight::register('userService', 'UserService');
Flight::register('lessonService', 'LessonService');
Flight::register('levelService', 'LevelService');
Flight::register('contactUsService', 'ContactUsService');
require_once __DIR__.'/routes/UserRoute.php';
require_once __DIR__.'/routes/LessonRoute.php';
require_once __DIR__.'/routes/LevelRoute.php';
require_once __DIR__ .'/routes/ContactUsRoute.php';


Flight::route('GET /docs.json', function(){
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});



  /*
Flight::route('/*', function(){
    $path = Flight::request()->url;
    if(   
         $path == '/login' 
        || $path == '/register' 
        || $path == '/docs.json' 
        || $path == '/verifyemail' 
        || $path == '/verify2fa' 
        || $path == '/qr'
        || $path == '/sms' 
        || $path == '/verify2faSMS'  
        || $path == '/resetpassswordemail' 
        || $path == '/resetpassword')
    {
        return TRUE;
    }
    
    $headers = getallheaders();
    if(@!$headers['Authorization']){
        Flight::json(["message" => "Unauthorized access"], 401);
        return FALSE;
    }else{
        try {
            $decoded = (array)JWT::decode($headers['Authorization'],new Key('example_key','HS256'));
        Flight::set('user',$decoded);
        
            return TRUE;
        } catch (\Exception $e) {
            Flight::json(["message" => "Token authorization invalid"], 403);
            return FALSE;
        }
    }
    print_r($headers);
});

*/
Flight::start();
?>
