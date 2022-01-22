<?php 
  include 'join.php';

  
  if(isset($_GET['sign']) ) 
  {
  	 
      $otp = $_GET['otp'];
      $email = $_GET['email'];
      $login = 1;
      $check = $getFromU->OTPverification($otp,$email);
      if($check==true){
       header('Location:date.php');
      }
      else
       echo 'Try again !!';
  }
 
?>
<html>
	<head>
		<title>MyProject</title>
         
	</head>

	<body>

	<div >	
		
	
  	
	<form>
		 <h3>Enter your email id again</h3>
		<input type="text" name="email" placeholder="Email">
		 <h3>Enter OTP to sign up</h3> 
		<input type="integer" name="otp" placeholder="Enter otp"></input>
		<button type="submit" name="sign" >signup</button>
	</form>
	    
   </div> 	

	</body>    
</html>