<?php


class Utils {

		public static function login($db,$input){
			
      $email = $input['email'];
      $password = md5($input['password']);
      $stmt  = $db->prepare("SELECT * FROM admin  WHERE email = :e AND password = :p ");

        //bind paramenters
        $data = [
          
          ':e' => $email,
          ':p' => $password
        ]; 

        $stmt->execute($data);

        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);



        if($count == 1 ){
            $_SESSION['login'] = 1;
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['img_path'] = $row['img_path'];

            

            header("location:index.php");
        

          }else{
            $message = "Invalid login details, try again!";
            header("location:login.php?message=$message");
          }

        }


        public static function checkEmail($db,$email){

           
           
            $stmt  = $db->prepare("SELECT email FROM admin  WHERE email = $email ");

           

        $stmt->execute();

        $count = $stmt->rowCount();
        if($count > 0){  
              return true ;
            }
      
}



        public static function uploadFile($files, $key){
              $result = [];
              $rnd = rand(00000,99999);
              $file_name = str_replace("", "_", $files[$key]['name']);
              $file_name = $rnd.$file_name;
              $folder = "img/".$file_name;
              if (move_uploaded_file($files[$key]['tmp_name'], $folder)) {
                $result[] =true;
                $result[] = $folder;
              }else{
                $result[] = false;
              }
              return $result;
               }



               public static function addAdmin($gggg, $input){


                $name = $input['fname']. " " . $input['lname'];


                $dbconnect  =  $gggg->prepare("INSERT INTO admin(name,email,password,img_path) VALUES (:n, :e, :p, :i )");

        //bind paramenters
        $data = [
          ':n' => $name,
          ':e' => $input['email'],
          ':p' => $input['hash_password'],
          ':i' => $input['loc']      




        ]; 
          if($dbconnect->execute($data)){
            header("location:login.php");
          }else{
            $message = "account could not be registered. Please try again later!";
            header("location:register.php?message=$message");
          }

        }
}




