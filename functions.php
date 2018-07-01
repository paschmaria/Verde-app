<?php 
	session_start();
    
    header("Access-Control-Allow-Origin: *");
	// connect to database
	$db = mysqli_connect('www.plurimustech.ng', 'plurimus_admin', 'Soluciales2018', 'plurimus_verde');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register button is clicked
	if (isset($_POST['register'])) {
		register();
	}

	// REGISTER USER
	function register(){
		global $db, $errors, $username, $email;

		// receive all input values from the form. 
		// call the e() function to escape form values
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// first check the database to make sure 
			// a user does not already exist with the same username and/or email
			$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
			$result = mysqli_query($db, $user_check_query);
			$user = mysqli_fetch_assoc($result);
			
			if ($user) { // if user exists
				if ($user['username'] === $username) {
					array_push($errors, "You are already registered!");
				} else if ($user['email'] === $email) {
					array_push($errors, "You are already registered!");
				}
			}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			$query = "INSERT INTO users (username, email, user_type, password) 
							VALUES ('$username', '$email', 'agent', '$password')";
			mysqli_query($db, $query);
			// if (!mysqli_query($db,$query)) {
			// 	echo "detaiks not inserted";
			// }
			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: dashboard');
			exit;
		}
	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=$id";
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
		echo $user;
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<p class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</p>';
		}
	}

	// log user out when logout link is clicked
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: login	");
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login'])) {
		login();
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: dashboard');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: dashboard');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	
    // 	Send SMS
    //rebuild form data
    $postdata = http_build_query(
        array(
            'username' => isset($_POST["username"])? $_POST["username"]: $_GET["username"],
            'password' => isset($_POST["password"])?$_POST["password"]: $_GET["password"],
            'message' => isset($_POST["message"])?$_POST["message"]: $_GET["message"],
            'mobiles' => isset($_POST["mobiles"])?$_POST["mobiles"]: $_GET["mobiles"],
            'sender' => isset($_POST["sender"])?$_POST["sender"]: $_GET["sender"],
        )
    );
    //prepare a http post request
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    //craete a stream to communicate with betasms api
    $context  = stream_context_create($opts);
    //get result from communication
    $result = file_get_contents('http://login.betasms.com/api/', false, $context);
    //return result to client, this will return the appropriate respond code
    echo $result;
    ?>