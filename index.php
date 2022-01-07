<?php
	session_start();

	include("includes/a_config.inc.php");

  // Login in user
  if( isset($_POST['login_btn']) ){

    $email      = sanitizeEmail($_POST['email']);
    $password   = sanitizePassword($_POST['password']);

    if(empty($email)){
      $errorMsg[] = "Please enter valid Email address";
    }
    elseif(empty($password)){
      $errorMsg[] = "Please enter password";
    }
    else{

      try{

        $conn = db();
        $sql = "SELECT userUUID, userFirstname, userLastname, userFunction, userEmail, userRole, userCreated, userPassword FROM users WHERE userEmail=? LIMIT 1"; // SQL with parameters
        $stmt = prepared_query($conn, $sql, [$email]);
        $user = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // fetch an array of rows
  
          if($user){
              if(password_verify($password,$user['0']['userPassword'])){

                $today = date("Y-m-d");

                $sql = "UPDATE users SET userLastSeen=? WHERE userEmail=?";
                prepared_query($conn, $sql, [$today, $email]);
               
              
              $_SESSION['user']['userUUID']   = $user['0']['userUUID'];
              $_SESSION['user']['firstname']  = $user['0']['userFirstname'];
              $_SESSION['user']['lastname']   = $user['0']['userLastname'];
              $_SESSION['user']['function']   = $user['0']['userFunction'];
              $_SESSION['user']['email']      = $user['0']['userEmail'];
              $_SESSION['user']['rolelevel']  = $user['0']['userRole'];
              $_SESSION['user']['created']    = $user['0']['userCreated'];
              $_SESSION['user']['lastseen']   = $today;
              $_SESSION['start']              = time();
              $_SESSION['expire']             = $_SESSION['start'] + $SessionExpire*60;

              header("location: dashboard.php");
  
            }
            else{
              $errorMsg[] = "Wrong email or password!";
            }
  
          }
          else{
            $errorMsg[] = "Wrong email or password!";
          }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
    }
  }
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<title><?php echo $PAGE_TITLE; ?></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/templatemo_main.css">
	<!-- 
Dashboard Template 
http://www.templatemo.com/preview/templatemo_415_dashboard
-->
</head>

<body>
	<div id="main-wrapper">
		<div class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<div class="logo">
					<h1>Dashboard - Admin Template</h1>
				</div>
			</div>
		</div>
		<div class="template-page-wrapper">
			<form class="form-horizontal templatemo-signin-form" role="form" action="index.php" method="post">
				<div class="form-group">
					<div class="col-md-12">
						<label for="Email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email" placeholder="user@email.com">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember me
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" name="login_btn" value="Sign in" class="btn btn-default">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="col-sm-offset-2 col-sm-10">
							<p>Don't have account? <a class="ms-2" href="mailto:support@triax.com?subject=Support%20Portal%3A%20User%20account%20request&body=Hi%20Support%2C%0A%0AI%20would%20like%20to%20have%20access%20to%20the%20Support%20Portal.%0APlease%20create%20an%20account%20for%20me%3A%0A%3CName%3E%0A%3CTRIAX%20Email%3E%0A%3CTRIAX%20Subsidiary%3E%0A%0AKind%20regards%2C%0A%3CNAME%3E">Request one</a></p>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>