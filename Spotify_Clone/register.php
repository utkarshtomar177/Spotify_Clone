<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);
	//$account -> register();

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name){
		if (isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spotify Clone</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<script src="js/register.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styleRegister.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
		if(isset($_POST['registerButton'])){
			echo '<script type="text/javascript">
						$(document).ready(function(){
				 /* $("#hideLogin").click(function(){
				    $("#loginForm").hide();
				    $("#registerForm").show();
				  });
		
				$("#hideregister").click(function(){
				    $("#loginForm").show();
				    $("#registerForm").hide();
				  });*/
				  
				  document.getElementById("hideLogin").click();
				  
				});
		
			</script>';
		}
	?>
	
	<!-- Heading Section -->
	<section >
		<div id="headingSection">
			<h2>Welcome to Spotify Clone</h2>
		</div>
	</section>
	<!-- login form -->
	<section >
		<div class="login">
			<div class="container">
				<hr class="headingLine" />
				<div class="inputContainer">
					<div class="frame" >

						<!-- <div class="nav">

							<ul class="links">
								<li class="signin-active"><a class="btn">Log in to your account</a></li>
								<li class="signup-inactive"><a class="btn">Register</a></li>
		 						 
							</ul>
	   					</div> -->
	   					

	   						<!-- Sign Up Form -->
					  		<form class="form-signin" action="" method="post" name="form" id="loginForm">
					  			<div class="nav">
									<ul class="links">
										<li class="signin-active"><a href="#">Login to your account</a></li>
										<!-- <li class="signup-inactive"><a class="btn">Register</a></li> -->
									</ul>
	   							</div>
					  			<?php echo $account->getError(Constants::$loginFailed);?>
								<label for="username">Username</label>
									<input class="form-styling" type="text" name="loginUsername" placeholder="e.g. utkarshtomar" value="<?php getInputValue('loginUsername');?>" required />
								<label for="password">Password</label>
									<input class="form-styling" type="password" name="loginPassword" placeholder="Your Password" required/>
									<input type="checkbox" id="checkbox"/>
								<label for="checkbox" ><span class="ui"></span>Keep me signed in</label>
								<div class="btn-animate">	
									<!--  <a class="btn-signin" >Sign in</a> -->
									<button type="submit" class="btn-signin" name="loginButton">Sign in</button>
								</div>
								
								<div class="createAccount">
									<a href="#" id="hideRegister">Already have an account? Sign in here.</a>
								</div>
				
							
						
							
							</form>

							    <!-- Sign Up Form -->
							<form class="form-signup" action="register.php" method="post" name="form" id="registerForm">
								<div class="nav">
									<ul class="links">
										<li class="signup-active"><a href="#">Create your free Account</a></li>
										<!-- <li class="signup-inactive"><a class="btn">Register</a></li> -->
									</ul>
	   							</div>
								<label for="username">Username</label>
									<?php echo $account->getError(Constants::$usernameRange);?>
									<?php echo $account->getError(Constants::$usernameTaken);?>
									<input class="form-styling" type="text" name="username" placeholder="e.g. utkarshtomar" value="<?php getInputValue('username');?>" required/>
								
								<label for="firstname">First Name</label>
									<?php echo $account->getError(Constants::$firstnameRange);?>
									<input class="form-styling" type="text" name="firstname" value="<?php getInputValue('firstname');?>" placeholder="e.g. Utkarsh" required/>
								<label for="lastname">Last Name</label>
									<?php echo $account->getError(Constants::$lastnameRange);?>
									<input class="form-styling" type="text" name="lastname" value="<?php getInputValue('lastname');?>" placeholder="e.g. Tomar" required/>
								<label for="email">Email</label>
									<?php echo $account->getError(Constants::$emailNotValid);?>
									<?php echo $account->getError(Constants::$emailDoNotMatch);?>
									<?php echo $account->getError(Constants::$emailTaken);?>
									<input class="form-styling" type="email" name="email" value="<?php getInputValue('email');?>" placeholder="e.g. utkarshtomar@gmail.com" required/>
								<label for="confirmemail">Confirm Email</label>
									
									<input class="form-styling" type="email" name="confirmemail" value="<?php getInputValue('confirmemail');?>" placeholder="e.g. utkarshtomar@gmail.com" required/>
								<label for="password">Password</label>
									<?php echo $account->getError(Constants::$passwordRange);?>
									<?php echo $account->getError(Constants::$passwordsOnlyAlphaNum);?>
									<?php echo $account->getError(Constants::$passwordsDoNotmatch);?>
									<input class="form-styling" type="password" name="password" placeholder="Your Password" required/>
								<label for="confirmpassword">Confirm password</label>
									
									<input class="form-styling" type="password" name="confirmpassword" placeholder="Confirm Password" required/>
								<!-- <a  class="btn-signup">Sign Up</a> -->
								<button type="submit" class="btn-signup" name="registerButton">Sign Up</button>
								<div class="AlreadyAccount">
									<a href="#" id="hideLogin">Already have an account? Sign up here.</a>
								</div>

							</form>
							<div  class="success">
								<svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" id="check" 	>
									<path fill="#ffffff" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314			c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
					c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578" />
								<!-- <div class="successtext">
									<p> Thanks for signing up! Check your email for confirmation.</p>
								</div> -->
	 						</div>
						
						
						
					</div>
				</div >

				<div id="loginText">
					<h1>Get great music, right now </h1>
					<h2>Listen to loads of songs for free </h2>
					<ul>
						<p><li>Discover music you'll fall in love with.</li></p>
						<p><li>Create your own playlists.</li></p>
						<p><li>Follow artists to keep up to date</li></p>
					</ul>
				</div>

				<a id="refresh" value="Refresh" onClick="history.go()">
					<svg class="refreshicon"   version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"   width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;" xml:space="preserve">
						<path  d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224	    c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5	    c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5	    c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025	    c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614	    l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z"/>
					</svg>
				</a>
			</div>
					
		</div>
	</section>
	

</body>
</html>