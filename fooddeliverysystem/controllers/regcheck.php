<?php 

    session_start();
    if(isset($_REQUEST['submit'])){

     
        $username = $_REQUEST['username']; 
        $password = $_REQUEST['password']; 
        $email = $_REQUEST['email'];
        $gender = $_REQUEST['gender']; 
        $dob = $_REQUEST['dob'];
        $name = $_REQUEST['name'];
        $role = $_REQUEST['role'];
        $confirmpassword= $_REQUEST['confirmpassword'];
        $address= $_REQUEST['address'];
        $phonenumber= $_REQUEST['phonenumber'];
        $joiningdate = date("Y-m-d");
        $profilepicture = "profilepicture.png";
        $emailexists = emailexists($email);
        $phonenumberexists = phonenumberexists($phonenumber);
        $usernameexists = usernameexists($username);
       

        if($username == "" || $password == "" ||empty($name)|| $email == "" || empty($gender)||empty($dob)||empty($role)||empty($address)||empty($phonenumber)) {
            echo "Null value ..";
            
        }
        elseif( $password != $confirmpassword  ) {
            echo "Password does not match";
            
        }
        elseif( strlen(trim($_REQUEST['password'])) < 8) {
            echo "Password must have at least 8 characters";
            
        }
        else if(strtotime($dob) > time()){
            echo "Date of birth cannot be greater than today's date";
        }
        
        

        else if(strtotime($dob) > strtotime("-16 years")){
            echo "You must be at least 16 years old to register";
        }
        else if($emailexists){
            echo "This Email is Already used.Try with another.";
        }
        else if($phonenumberexists){
            echo "This Phone Number is Already used.Try with another.";
        }
        else if($usernameexists){
            echo "This Username is Already used.Try with another.";
        }

        else{



       
        $user = ['username'=> $username, 'password'=> $password, 'role' => $role, 'email'=> $email, 'name'=> $name, 'dob'=> $dob, 'gender'=> $gender, 'address'=> $address ,'joiningdate'=> $joiningdate,'phonenumber'=> $phonenumber,'profilepicture'=> $profilepicture];
        $status = addUser($user);
        if($status){
            createappwallet($user);
            if($role=="vendor" || $role=="customer" || $role=="deliveryman")
            {
                header('location: ../views/login.php');
            }
            else if($role=="admin")
            {
              
            header('location: ../views/adminlist.php');
            }
            else{
                echo "error";
            }
        }else{
            echo "DB error, try again";
        }
    }
}
    else{
        echo "invalid request...";
    }
?>