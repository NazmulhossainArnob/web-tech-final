<?php 
require_once '../models/usermodel.php';
    session_start();
  

        $data = $_POST['data'];
        $user = json_decode($data);
        $username = $_SESSION['username']; 
        $password = $_SESSION['password']; 
        $name = $user->name;
        $email = $user->email;
        $gender = $user->gender;
        $dob = $user->dob;
        $address = $user->address;
        $phonenumber = $user->phonenumber;
       


        if(empty($name)|| $email == "" || empty($gender)||empty($dob)||empty($address)||empty($phonenumber)) {
            echo "Null value ..";
            
        }
       
        else if(strtotime($dob) > time()){
            echo "Date of birth cannot be greater than today's date";
        }
        
        

        else if(strtotime($dob) > strtotime("-16 years")){
            echo "You must be at least 16 years old ";
        }
        else
        {
            $user = ['username'=> $username,'email'=> $email, 'name'=> $name, 'dob'=> $dob, 'gender'=> $gender, 'address'=> $address ,'phonenumber'=> $phonenumber];
            $status = editprofile($user);
                    if($status){

                        
                     
                        $_SESSION['name']=$name;
                        $_SESSION['email']= $email;
                        $_SESSION['gender']= $gender;
                        $_SESSION['dob']= $dob;
                        $_SESSION['phonenumber']= $phonenumber;
                        $_SESSION['address']= $address;
                       
                        echo "Updated Successfully!";
                        
                    }else{
                        echo "Something went Wrong! try again.";
                    }
        }


?>