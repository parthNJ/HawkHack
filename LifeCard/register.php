<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
		 </script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
		</script>
		<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
		<link rel="stylesheet"  href="index.css" media="Screen" type = "text/css" >
  </head>
  <body>
    <br><br><br><br>
    <p class ="aboutMe-IntoTxt">LifeCard.</p>
    <h3 class="aboutMe-innertxt-final">Your personal health organizer.</h3>
    <form method = "post" action = "loginServer.php" class="form-signin">
        <input type="text" name = "fname" class="form-control" placeholder="First Name" required autofocus>
        <input type="text" name = "lname" class="form-control" placeholder="Last Name" required>
        <input type="text" name = "email" class="form-control" placeholder="Email" required>
        <input type="password" name = "password" class="form-control" placeholder="Password" required>
        <input type="password" name = "password2" class="form-control" placeholder="Confirm Password" required>
        <button type="submit" name = "register_btn" class="btn btn-lg btn-primary btn-block" >
            Register
        </button>

        <a href="login.php" class="text-center new-account">Login </a>
         </div>

        </div>
    </form>
  </body>
</html>
