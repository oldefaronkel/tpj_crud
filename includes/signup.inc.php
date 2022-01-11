<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $usersFirstname = $_POST["usersFirstname"];
  $usersLastname = $_POST["usersLastname"];
  $usersUid = $_POST["usersUid"];
  $usersEmail = $_POST["usersEmail"];
  $usersFunction = $_POST["usersFunction"];
  $usersPwd = $_POST["usersPwd"];
  $usersPwdRepeat = $_POST["usersPwdRepeat"];
  $usersRole = 'User';

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  //require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($usersFirstname, $usersLastname, $usersEmail, $usersFunction, $usersUid, $usersPwd, $usersPwdRepeat, $usersRole) !== false) {
    header("location: ../signup.php?error=emptyinput");
		exit();
  }
	// Proper username chosen
  if (invalidUid($usersUid) !== false) {
    header("location: ../signup.php?error=invaliduid");
		exit();
  }
  // Proper email chosen
  if (invalidEmail($usersEmail) !== false) {
    header("location: ../signup.php?error=invalidemail");
		exit();
  }
  // Do the two passwords match?
  if (pwdMatch($usersPwd, $usersPwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
		exit();
  }
  // Is the username taken already
  if (uidExists($conn, $usersUid) !== false) {
    header("location: ../signup.php?error=usernametaken");
		exit();
  }
  // Invalid function
  if (validFunction($conn, $usersFunction) !== false) {
    header("location: ../signup.php?error=usernametaken");
		exit();
  }


  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $usersFirstname, $usersLastname, $usersEmail, $usersFunction, $usersUid, $usersPwd, $usersRole);

} else {
	header("location: ../signup.php");
    exit();
}
