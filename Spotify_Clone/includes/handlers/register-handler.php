<?php

	function sanitizePassword($inputText){
		$inputText = strip_tags($inputText);
		
		return $inputText;
	}

	function sanitizeUsername($inputText){
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ","", $inputText);
		return $inputText;
	}

	function sanitizeFields($inputText){
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ","", $inputText);
		$inputText = ucfirst(strtolower($inputText));
		return $inputText;
	}

	


	if (isset($_POST['registerButton'])) {
		//echo "registerButton was pressed";
		//SANITIZATION
		$username = sanitizeUsername($_POST['username']);
		

		$firstname = sanitizeFields($_POST['firstname']);

		$lastname = sanitizeFields($_POST['lastname']);

		$email = sanitizeFields($_POST['email']);

		$confirmemail = sanitizeFields($_POST['confirmemail']);

		$password = sanitizePassword($_POST['password']);

		$confirmpassword = sanitizePassword($_POST['confirmpassword']);


		$wasSuccessful = $account -> register($username , $firstname , $lastname , $email , $confirmemail , $password , $confirmpassword );

		if($wasSuccessful == true){
			$_SESSION['userLoggedIn'] = $username;
			header("location: index.php");
		}
		
	}
?>