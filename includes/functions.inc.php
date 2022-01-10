<?php

// Check for empty input signup
function emptyInputSignup($firstname, $lastname, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $firstname, $lastname, $email, $username, $pwd) {
  $sql = "INSERT INTO users (usersUUID, usersEmail, usersUid, usersPwd, usersRole, usersFirstname, usersLastname) VALUES (?, ?, ?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$userhashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	$userUUID = gen_uuid();
	$userRole = "User";

	mysqli_stmt_bind_param($stmt, "sssssss", $userUUID, $email, $username, $userhashedPwd, $userRole, $firstname, $lastname);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../login.php");
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userUUID"] = $uidExists["usersUUID"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		$_SESSION["userrole"] = $uidExists["usersRole"];
		header("location: ../index.php");
		exit();
	}
}


function gen_uuid() {
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
	
	$uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
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