<?php

require_once __DIR__ . '/../env.class.php';

//Tutorials show
Flight::route('GET /tutorials', function(){
 Flight::json(Flight::lessonService()->get_tutorials());
 });
/**
* @OA\Get(path="/lessons",tags={"lessons"},security={{"ApiKeyAuth":{}}},
*         summary ="List all lessons",
*         @OA\Response(response=200,description="All lessons")
* )
*/
 Flight::route('GET /lessons', function(){

  Flight::json(Flight::lessonService()->get_all());
  //Flight::json(array('id' => 123));
});


/**
* @OA\Get(path="/lessons/{id}",tags={"lessons"},security={{"ApiKeyAuth":{}}},
*         summary ="List lesson by id",
*         @OA\Parameter(in="path",name="id",example=1,description="lesson id"),
*         @OA\Response(response=200,description="Lessons by id")
* )
*/
 Flight::route('GET /lessons/@id', function($id){

  Flight::json(Flight::lessonService()->get_lessons($id));
  //Flight::json(array('id' => 123));
});



 /**
 * @OA\Put(
 *     path="/lessons/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit lesson",
 *     tags={"lessons"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Lesson ID"),
 *     @OA\RequestBody(description="Student info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name", type="string", example="Demo",	description="Lesson name"),
 *    				@OA\Property(property="image_path", type="string", example="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg",	description="Image" ),
 *            @OA\Property(property="lesson_path", type="string", example="newLetter.html",	description="Lesson path" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Lesson has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route('PUT /lessons/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::lessonService()->update($id, $data);
  Flight::json(Flight::lessonService()->get_lessons($id));
});


 /**
 * @OA\Delete(
 *     path="/lessons/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete lesson",
 *     tags={"lessons"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Lesson ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Note deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route('DELETE /lessons/@id', function($id){

  Flight::json(Flight::lessonService()->delete($id));
  //Flight::json(array('id' => 123));
});


//Lesson upload
Flight::route('POST /upload', function () {
    $upload_data = Flight::request()->data->getData();

  /*   $request = Flight::request();
    $file = Flight::request()->files; */
    $uploaddir = $_SERVER['DOCUMENT_ROOT'];
   
/* 
    $tmpName = $file['lesson_path'];
    $fileName = $file['lesson_path'];
    move_uploaded_file($file, $uploaddir . $fileName);  */
    $request = Flight::request();
    $file = $request->files['lesson_path']; 

    Flight::json(['upload' => $file ]);

    //Flight::lessonService()->add_element($upload_data);
    // Flight::json(['upload' => $upload_data]);
      //Flight::json(['upload' => $request ]);

    /*     if (Flight::request()->getBody()){
            // Where the file is going to be stored
                $target_dir = $_SERVER['DOCUMENT_ROOT'];
                $file = Flight::request()->getBody();
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = Flight::request()->getBody();
                $path_filename_ext = $target_dir.$filename.".".$ext;
             
            // Check if file already exists
            if (file_exists($path_filename_ext)) {
           
             Flight::json(['upload' => "Sorry, file already exists."]);
             }else{
             move_uploaded_file($temp_name,$path_filename_ext);
            
             Flight::json(['upload' => "Congratulations! File Uploaded Successfully."]);
             }
            }  */
});
?>