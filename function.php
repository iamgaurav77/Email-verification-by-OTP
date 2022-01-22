<?php

class functions{

	protected $pdo;

 	public function __construct($pdo){											
	    $this->pdo = $pdo;
	}

	public function Signin($name,$email,$password,$is_expired,$otp){
       $insertQuery = " INSERT INTO users (name,email,password,is_expired,otp) values(:name, :email, :password, :is_expired, :otp) ";
       $stmt = $this->pdo->prepare($insertQuery);
       $stmt->bindParam(":name", $name, PDO::PARAM_STR);
 	   $stmt->bindParam(":email", $email , PDO::PARAM_STR);
	   $stmt->bindParam(":password", $password, PDO::PARAM_STR);
	   $stmt->bindParam(":is_expired", $is_expired, PDO::PARAM_STR);
	   $stmt->bindParam(":otp", $otp, PDO::PARAM_STR);
	   
	   $stmt->execute();
	}

	public function OTPupdate($email,$otp){
       
       $checkQuery = "UPDATE users SET otp=$otp WHERE email = :email";
       $stmt = $this->pdo->prepare($checkQuery);
	   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
	   $stmt->execute();

	}

	public function VerifyMe($login){
       $insertQuery = " INSERT INTO users (login) values(:login) ";
       $stmt = $this->pdo->prepare($insertQuery);
	   $stmt->bindParam(":login", $login, PDO::PARAM_STR);
	   
	   $stmt->execute();
	}



	public function login($email, $password, $login){
		$checkQuery = "SELECT * FROM users WHERE email=:email and password=:password and login=:login";
		$stmt = $this->pdo->prepare($checkQuery);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		$user = $stmt->fetch(PDO::FETCH_OBJ);

		if($count > 0){
			//echo 'Welcome ';
			//echo $user->name;
			return true;
		}else{
			return false;
		}
	}

	public function halfRegistered($email){
		$checkQuery = "SELECT * FROM users WHERE email=:email";
		$stmt = $this->pdo->prepare($checkQuery);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		$user = $stmt->fetch(PDO::FETCH_OBJ);

		if($count > 0){
			if($user->login==1)
              return 2;
            else
              return 3;
		}else{
			return 1;
		}
	}

	public function OTPverification($otp,$email){
       $checkQuery = "SELECT * FROM users WHERE otp=:otp and email=:email";
       $stmt = $this->pdo->prepare($checkQuery);
	   $stmt->bindParam(':otp', $otp, PDO::PARAM_STR);
	   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
	   $stmt->execute();

	   $count = $stmt->rowCount();
	   $user = $stmt->fetch(PDO::FETCH_OBJ);

	   if($count > 0){
	   	    date_default_timezone_set("Asia/Kolkata");
	   	    $dbtime = $user->is_expired;
	   	    $dbtime = strtotime($dbtime);
	   	    //echo date('Y-m-d H:i:s', $dbtime);

	   	    //echo "-----";
			//$first = strtotime($dbtime);
			
			$date1 = date('Y-m-d H:i:s');
			//echo $date1;
			$date1 = strtotime($date1);
			//echo "------";
			$second = strtotime("-10 minute", $date1);
			//echo date('Y-m-d H:i:s', $second);

			
            if($second<=$dbtime){
                  
               //echo "time hai abhi";
               $checkQuery = "UPDATE users SET login = 1 WHERE email = :email";
               $stmt = $this->pdo->prepare($checkQuery);
	           $stmt->bindParam(':email', $email, PDO::PARAM_STR);
	           $stmt->execute();
               return true;
            }
            else{
              //echo "time chala gaya";
              return false;
            }
            
		}else{
			//echo 'not verifed';
			return false;
		}

	}
}

?>