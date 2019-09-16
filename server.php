<?php
session_start();

////////////////////////////////////////////////////////////////////
//PAS DEZE VARIABELEN AAN MET JE EIGEN DATABASE CONNECTIE GEGEVENS
$databaseserver =  "mysqlstudent";
$databasegebruiker = "jensdemuynziem7i";
$databasegebruikerpaswoord = "AiCei3Aesh6K";
$databasenaam = "jensdemuynziem7i";
//ZORG DAT BOVENSTAANDE GEGEVENS GEKOPIEERD EN INGEVULD WORDEN
////////////////////////////////////////////////////////////////////

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = new mysqli($databaseserver, $databasegebruiker, $databasegebruikerpaswoord, $databasenaam);

// REGISTER USER
if (isset($_POST['reg_user'])) {

  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['cpsw']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tblUsers WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_BCRYPT);//encrypt the password before saving in the database

  	$query = "INSERT INTO tblUsers (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {  
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $password = mysqli_real_escape_string($db, $_POST['psw']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    // Find the stored password hash in the db, searching by username
    $query = "SELECT password FROM tblUsers WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $username); // it is safe to pass the user input unescaped
    $stmt->execute();

    // If this user exists, fetch the password-hash and check it
    $isPasswordCorrect = false;
    $stmt->bind_result($hashFromDb);
    if ($stmt->fetch() === true)
    {
      // Check whether the entered password matches the stored hash.
      // The salt and the cost factor will be extracted from $hashFromDb.
      $isPasswordCorrect = password_verify($password, $hashFromDb);
    }
    $stmt->close();

    
    if($isPasswordCorrect === true){
      $hash_query = "SELECT * FROM tblUsers WHERE username='$username' and password='$hashFromDb' LIMIT 1";
      $result = mysqli_query($db, $hash_query);

      if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      } else {
        array_push($errors, "Wrong username/password combination");
      }
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
