<?php
 

header('content-type: application/json');

      $request=$_SERVER['REQUEST_METHOD'];

   switch ( $request) {
   	case 'GET':
   		getmethod();
   	break;
   	case 'PUT':
          $data=json_decode(file_get_contents('php://input'),true);
         putmethod($data);
   	break;
   	case 'POST':
   		$data=json_decode(file_get_contents('php://input'),true);
         postmethod($data);
   	break;
   	case 'DELETE':
   		$data=json_decode(file_get_contents('php://input'),true);
         deletemethod($data);
   	break;
   	
   	default:
   		echo '{"name": "data not found"}';
   		break;
   }
//lecture des données
function getmethod(){
  include "connexion.php";
  $sql = "SELECT * FROM article";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) > 0) {
       $rows=array();
       while ($r = mysqli_fetch_assoc($result)) {

          $rows["result"][] = $r;
       }

       echo json_encode($rows);
  }  else{
      echo '{"result": "no data found"}';
    }
}
//inserer les données
function postmethod($data){
   include "connexion.php";
   $name=$data["title"];
   $email=$data["description"];
   $published=$data["published"];

   $sql= "INSERT INTO article(title, description, published) VALUES ('$title' , '$description', 'published', NOW())";

   if (mysqli_query($con , $sql)) {
      echo '{"result": "data inserted"}';
   } else{

      echo '{"result": "data not inserted"}';
   }



}

//modification des données
function putmethod($data){
   include "connexion.php";
   $id=$data["id"];
   $title=$data["title"];
   $description=$data["description"];
   $published=$data["published"];

   $sql= "UPDATE article SET title='$title', email='$email', description='$description', published='$published' where id='$id'  ";

   if (mysqli_query($con , $sql)) {
      echo '{"result": "Update Succesfully"}';
   } else{

      echo '{"result": "not updated"}';
   }



}
//suppression des données
function deletemethod($data){
   include "connexion.php";

   $id=$data["id"];
   


   $sql= "DELETE FROM article where id=$id";

   if (mysqli_query($con , $sql)) {
      echo '{"result": "delete Succesfully"}';
   } else{

      echo '{"result": "not deleted"}';
   }
}
?>