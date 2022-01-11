<?php
//Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "dbh.inc.php";

// General Information

$siteTitle		= "TPJ Crud";
$siteVersion	= "v1.0.0";


// Check for empty input signup
function emptyInputSignup($usersFirstname, $usersLastname, $usersEmail, $usersFunction, $usersUid, $usersPwd, $usersPwdRepeat, $usersRole)
{
	$result;
	if (empty($usersFirstname) || empty($usersLastname) || empty($usersEmail) || empty($usersFunction) || empty($usersUid) || empty($usersPwd) || empty($usersPwdRepeat) || empty($usersRole)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($usersUid)
{
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $usersUid)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check invalid function
function validFunction($usersFunction)
{
	$result;
	if ($usersFunction === "Select function") {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($usersEmail)
{
	$result;
	if (!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($usersPwd, $usersPwdRepeat)
{
	$result;
	if ($usersPwd !== $usersPwdRepeat) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $usersUid)
{
	$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $usersUid, $usersUid);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $usersFirstname, $usersLastname, $usersEmail, $usersFunction, $usersUid, $usersPwd, $usersRole)
{
	$sql = "INSERT INTO users (usersUUID, usersEmail, usersFunction, usersUid, usersPwd, usersRole, usersFirstname, usersLastname) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$userhashedPwd = password_hash($usersPwd, PASSWORD_DEFAULT);
	$userUUID = gen_uuid();

	mysqli_stmt_bind_param($stmt, "ssssssss", $userUUID, $usersEmail, $usersFunction, $usersUid, $userhashedPwd, $usersRole, $usersFirstname, $usersLastname);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../login.php?error=login");
	exit();
}

// Check for empty input login
function emptyInputLogin($usersUid, $usersPwd)
{
	$result;
	if (empty($usersUid) || empty($usersPwd)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $usersUid, $usersPwd)
{
	$uidExists = uidExists($conn, $usersUid);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($usersPwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	} elseif ($checkPwd === true) {
		session_start();
		$_SESSION['user']['UUID'] = $uidExists["usersUUID"];

		$userData = getUserData($conn, $uidExists["usersUUID"]); // Get the rest of the user data based on the UUID

		$_SESSION['user']['Uid'] 		= $userData["usersUid"];
		$_SESSION['user']['Firstname']	= $userData["usersFirstname"];
		$_SESSION['user']['Lastname']	= $userData["usersLastname"];
		$_SESSION['user']['Role']		= $userData["usersRole"];
		$_SESSION['user']['Email']		= $userData["usersEmail"];
		$_SESSION['user']['Title']		= $userData["userfunctionsTitle"];

		header("location: ../index.php");
		exit();
	}
}

// Get data on a single specific user
function getUserData($conn, $userUUID)
{
	$sql = "SELECT users.usersUUID, users.usersUid, users.usersFirstname, users.usersLastname, users.usersRole, users.usersEmail, users.usersCompany, users.usersCountry, users.usersAbout, users.usersAddress, users.usersZipcode, users.usersCity, userfunctions.userfunctionsTitle FROM users LEFT JOIN userFunctions ON users.usersFunction = userFunctions.userfunctionsId WHERE users.usersUUID = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location:?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $userUUID);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}
// Generate UUIDv4 for user
function gen_uuid()
{
	$uuid = array(
		'time_low'  => 0,
		'time_mid'  => 0,
		'time_hi'  => 0,
		'clock_seq_hi' => 0,
		'clock_seq_low' => 0,
		'node'   => array()
	);

	$uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
	$uuid['time_mid'] = mt_rand(0, 0xffff);
	$uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
	$uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
	$uuid['clock_seq_low'] = mt_rand(0, 255);

	for ($i = 0; $i < 6; $i++) {
		$uuid['node'][$i] = mt_rand(0, 255);
	}

	$uuid = sprintf(
		'%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
		$uuid['time_low'],
		$uuid['time_mid'],
		$uuid['time_hi'],
		$uuid['clock_seq_hi'],
		$uuid['clock_seq_low'],
		$uuid['node'][0],
		$uuid['node'][1],
		$uuid['node'][2],
		$uuid['node'][3],
		$uuid['node'][4],
		$uuid['node'][5]
	);

	return $uuid;
}
