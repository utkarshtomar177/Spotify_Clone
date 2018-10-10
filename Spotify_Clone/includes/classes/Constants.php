<?php
	/**
	* Constant class
	*/
	class Constants
	{
		//Register Error Messages
		public static $passwordsDoNotmatch = "Passwords don't match!";
		public static $passwordsOnlyAlphaNum = "Password should only contain UpperCase/LowerCase Alphabets and Numbers!";
		public static $passwordRange = "Your password must be between 5 &amp; 30 characters!";

		public static $emailDoNotMatch = "Your Emails don't match!";
		public static $emailNotValid = "Please enter a valid E-mail!";

		public static $lastnameRange = "Your Lastname must be between 2 &amp; 25 characters!";

		public static $firstnameRange = "Your Firstname must be between 2 &amp; 25 characters!";

		public static $usernameRange = "Your username must be between 5 &amp; 25 characters!";
		
		public static $usernameTaken = "This username already exists!";

		public static $emailTaken = "This E-mail already exists!";

		//SuccessFull Registration 
		public static $registrationSuccess = "Your registration was successful!";

		//Login Error Messages

		public static $loginFailed = "Your Username or Password was incorrect!";
	}
?>