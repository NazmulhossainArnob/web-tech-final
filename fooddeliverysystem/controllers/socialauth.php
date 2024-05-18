<?php
  session_start();


if(isset($_GET['code']))
{


$status = googlesignin($email);
        if($status){
            setcookie('flag', 'asif', time()+300, '/');
            if (trim($_SESSION['role'])=="admin")
            {
                header('location: ../views/admindashboard.php');
            }
            else if (trim($_SESSION['role'])=="vendor")
            {
                
                header('location: ../views/vendordashboard.php');
            }
          
            
        }
        else{
            $_SESSION['name']= $name;
            $_SESSION['email']= $email;
            setcookie('flag', 'asif', time()+300, '/');
            header('location: ../views/updateinformation.php');
        }

}

else
{   
    echo "<table align='center' height=300>
    <tr height=300>
    <td align='center'>
        
    <h2>FoodRush is requesting access to: </h2>
    Your name and email address.
    </td>
    </tr>
    <tr >
        <td align='center'>
        
        <a href='".$client->createAuthUrl()."'><h3>Continue</h3></a>
        </td>
  
    </tr>
    <tr>
    <td align='center'>
    <a href='../views/login.php'><h3>Cancel</h3></a>
    </td>
    </tr>
  
</table>";
}
?>







