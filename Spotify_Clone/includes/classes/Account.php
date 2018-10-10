<?php 
	/**
	* Class for Account creation
	*/
	class Account 
	{	
		private $con;
		private $errorArray;
		

		
		public function __construct($con){
				$this -> con = $con;
				$this -> errorArray = array();
				
			}

		public function login($uname, $pass){
			$pass = md5($pass);
			$query = mysqli_query($this->con,"SELECT * FROM users WHERE username = '$uname' AND password ='$pass'");

			if(mysqli_num_rows($query)==1){
				return true;
			}
			else{
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}


		}

		public function register($uname,$fname,$lname,$em , $em2, $pass , $confirmpass){
			$this -> validateUsername($uname);
			$this -> validateLastname($lname);
			$this -> validateFirstname($fname);
			$this -> validateEmails($em, $em2);
			$this -> validatePasswords($pass , $confirmpass);

			if(empty($this-> errorArray)==true){
				
				return $this-> insertUserDetails($uname,$fname,$lname,$em, $pass );

			}
			else{
				return false;
			}
		}

		public function getError($error){
			if(!in_array($error, $this->errorArray)){
				$error = "";

			}
			return "<span class='errorMessage'>$error</span>";

		}

		

		private function insertUserDetails($uname ,$fname,$lname,$em, $pass ){
			$encryptedPw = md5($pass);

			$profilePic ="images/profile-pics/profile.jpg";

			$date = date("Y-m-d");

			$result = mysqli_query($this-> con, "INSERT INTO users VALUES('','$uname','$fname','$lname','$em','$encryptedPw','$date','$profilePic')");

			return $result;
		}


		private function validateUsername($uname){
			
			if(strlen($uname) > 25 || strlen($uname) <5){
				array_push($this -> errorArray , Constants::$usernameRange);
				return;

			}

			$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$uname'");
			if(mysqli_num_rows($checkUsernameQuery) != 0) {
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}
		}
		
		private function validateFirstname($fname){

			if(strlen($fname) > 25 || strlen($fname) <2){

				array_push($this -> errorArray , Constants::$firstnameRange);
				return;
			}
		
		}
		
		private function validateLastname($lname){

			if(strlen($lname) > 25 || strlen($lname) <2){
				array_push($this -> errorArray , Constants::$lastnameRange);
				return;
			}
		
		}
		
		private function validateEmails($em , $em2){

			if ($em != $em2) {
				array_push($this -> errorArray , Constants::$emailDoNotMatch);
				return;
			}

			if(!filter_var($em , FILTER_VALIDATE_EMAIL)){
				array_push($this -> errorArray , Constants::$emailNotValid);
				return;
			}

			$checkEmail = mysqli_query($this->con, "SELECT email FROM users WHERE email ='$em'");

			if(mysqli_num_rows($checkEmail )!= 0){
				array_push($this-> errorArray, Constants::$emailTaken);
				return;
			}
		
		}
		
		private function validatePasswords($pass , $confirmpass){

			if($pass != $confirmpass ){
				array_push($this -> errorArray , Constants::$passwordsDoNotmatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pass)){
				array_push($this -> errorArray , Constants::$passwordsOnlyAlphaNum);
				return;
			}

			if(strlen($pass) > 30 || strlen($pass) <5){
				array_push($this -> errorArray , Constants::$passwordRange);
				return;
			}

		
		}
		
	}
?>