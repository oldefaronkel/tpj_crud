<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<title>Dashboard Sign In, Free Admin Template<?php echo $PAGE_TITLE; ?></title>
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
					<h1>Support: Login</h1>
				</div>
			</div>
		</div>
		<div class="template-page-wrapper">

			<form class="form-horizontal templatemo-signin-form" role="form" action="includes/login.inc.php" method="post">

				<?php
				// Error messages
				if (isset($_GET["error"])) {
					if ($_GET["error"] == "emptyinput") {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<strong>Error!</strong> emptyinput - Maecenas non lorem sed elit molestie tincidunt.
						</div>
				<?php
						echo "<p>Fill in all fields!</p>";
					} else if ($_GET["error"] == "wronglogin") {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<strong>Error!</strong> wronglogin - Maecenas non lorem sed elit molestie tincidunt.
						</div>
				<?php
					}
				}
				?>



				<div class="form-group">
					<div class="col-md-12">
						<label for="Email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="uid" placeholder="Username/Email...">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="pwd" placeholder="Password...">
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