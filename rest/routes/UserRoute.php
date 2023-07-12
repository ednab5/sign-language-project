
<?php

require_once __DIR__.'/../env.class.php';
require_once __DIR__.'/../../phpMailer/src/Exception.php';
require_once __DIR__.'/../../phpMailer/src/PHPMailer.php';
require_once __DIR__.'/../../phpMailer/src/SMTP.php';

use Firebase\JWT\JWT;



/**
 * @OA\Post(
 *     path="/login",
 *     summary="Login with example user",
 *     description="User login",
 *     operationId="loginUser",
 *     tags={"user"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="username",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 *                 example={"username": "admin", "password": "Ajdishjfiasd@vdsjfosd"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="JWT Token on successful response"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Wrong Password | User doesn't exist"
 *     )
 * )
 */
 Flight::route('POST /login', function(){
 $data = Flight::request()->data->getData();
 $user = Flight::userService()->get_user_by_username($data['username']);

 if(isset($user['userId'])){
   if($user['password'] == $data['password']){
     unset($user['password']);
     $jwt = JWT::encode($user, 'ezcb9s8UcF', 'HS256');
     Flight::json(["token"=>$jwt]);
   }else{
     Flight::json(["message"=>"Password is not correct"],404);

   }
 }else{
   Flight::json(["message"=>"User doesn't exist"],404);
 }
 
 });




?>
