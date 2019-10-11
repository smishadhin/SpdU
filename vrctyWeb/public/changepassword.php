<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

	<div class="back"></div>
	<div class="container">
		<div class="row">
			<div class="wrapper_login">
				<div class="Login_header col-md-offset-3 col-md-6">
					<h2>Change Password</h2>
				</div>
				<div class="login col-md-offset-3 col-md-6">
					<form>
						<div class="form-group">
							<input type="password" class="form-control" id="exampleInputEmail1" placeholder="Current Password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
						</div><div class="form-group">
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Retype New Password">
						</div>

							<a href=""><button type="submit" class="btn btn-success btn-block">Submit</button></a>
						<a href=""><button type="button" class="btn btn-success btn-block">BACK</button></a>
					</form>
				</div><!-- End Login -->
			</div><!-- End Wrapper -->
		</div><!-- End Row -->
	</div><!-- End Container -->
</body>
</html>
