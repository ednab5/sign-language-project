<?php

require_once __DIR__ . '/../env.class.php';

/**
* @OA\Get(path="/levels",tags={"levels"},security={{"ApiKeyAuth":{}}},
*         summary ="List all levels",
*         @OA\Response(response=200,description="Levels")
* )
*/
//Tutorials show
Flight::route('GET /levels', function(){
 Flight::json(Flight::levelService()->get_levels());
 

  });