<?php 
  include 'join.php';

  //Sign up part
 if(isset($_GET['sign']) ) {
  $name = $_GET['name'];
  $email = $_GET['email'];
  $password = $_GET['password'];
  $first = true;

  $checking = $getFromU->halfRegistered($email);


  if(strlen($name)>40 or strlen($name)==0)
  {
  	if(strlen($name)>40)
     echo 'the name is too big';
    else
      echo 'the name is mandatory';
    $first = false;
  }
  else if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
  	echo 'enter the valid email id';
    $first = false;
  }
  else if(strlen($password)<8){
  	echo 'password should be greater';
  	$first = false;
  }
  else if($checking==2){
    echo 'email already is use login to enter';
    $first = false;
  }
  else if($checking==3){
    echo 'Email registered but not verified';
    $first = false;

    date_default_timezone_set("Asia/Kolkata");

    
    $otp  = random_int(100000, 999999);
    $getFromU->OTPupdate($email,$otp);

    $to_email = $email;
    $subject = "Verification";
    $body = $otp;
    $headers = "From: 19bcs1474@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        header('Location:emailVerify.php');;
    } else {
        echo "Email sending failed...";
    }
  }

  if($first==true) {
    
    date_default_timezone_set("Asia/Kolkata");

    $is_expired = date('Y-m-d H:i:s');
    $otp  = random_int(100000, 999999);
    $getFromU->Signin($name,$email,$password,$is_expired,$otp);

    $to_email = $email;
    $subject = "Verification";
    $body = $otp;
    $headers = "From: 19bcs1474@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        header('Location:emailVerify.php');;
    } else {
        echo "Email sending failed...";
    }

    /*if(isset($_GET['verify']) ) 
    {
      $otp = $_GET['otp'];
      echo $otp;
      $check = $getFromU->OTPverification($email,$otp);
      if($check==true)
       header('Location:date.php');
      else
       echo 'Try again !!';
    }
    else
      echo 'not set';*/

   // header('Location:emailVerify.php');
  }
}

//login part
 if(isset($_GET['login'])) {
    $login = 1;
 	  $email = $_GET['email'];
    $password = $_GET['password'];
    $check = $getFromU->login($email,$password,$login);
    if($check==true)
      header('Location:date.php');
    else
      echo 'Invalid details';
 }

?>
<html>
	<head>
		<title>MyProject</title>
         
        <style type="text/css">
        	.first{
        		float:left;
        		margin-left: 100px;
        	}
        	.second{
        		float: left;
        		margin-left: 300px;
        	}
     
        </style>

	</head>

	<body>

   

	<div class="first">	
		<h1>Enter details to sign up</h1> 
	
  	
	<form>
		<h3>Enter your name</h3>
		<input type="text" name="name" placeholder="Enter name"></input>
		<h3>Enter your email id</h3>
		<input type="text" name="email" placeholder="Email">
	    <h3>Enter your password</h3>
		<input type="password" name="password" placeholder="minimum length is eight"></input>
		<p> <p>
		<button type="submit" name="sign" >signup</button>
	</form>
	    
  
   </div> 


   <div class="second">
	    <h1> Already a user ?? </h1>
	    <form>
	    <h3>Enter your email id</h3>
		<input type="text" name="email" placeholder="Email">
	    <h3>Enter your password</h3>
		<input type="password" name="password"></input>
		<p> </p>
     <input type="submit" class="btn"  name="login" value="Login">
	    </form>
   </div>	

 
  

	</body>    
</html>