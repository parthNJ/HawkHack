
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
  <link rel="stylesheet"  href="UpdateForm.css" media="Screen" type = "text/css" >
  </head>
  <body>


<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'lifecard');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<a href = 'login.php'>Logout</a>";

if(isset($_GET['updateCoreInfo'])){
  $x = ((int)$_GET['updateCoreInfo']);

  $sql = "SELECT * FROM patientinfo WHERE pid='$x'";
  $result = mysqli_query($conn, $sql);

  echo "".'<a class = "explore" href = "doctorindex.php?returnBack='.$x.'">BackToHome</a>'." ";

  if(mysqli_num_rows($result) == 1){
    while($row = mysqli_fetch_assoc($result)){

      $height = $row["height"];
      $weight = $row["weight"];
      $bloodtype = $row["bloodtype"];
      $medications = $row["medications"];
      $allergies = $row["allergies"];
      $primaryDoctor = $row["primaryDoctor"];
      $problems = $row["problems"];
      $primaryCareLocation = $row["PrimaryCareLocation"];
      $insurance = $row["Insurance"];
    }
  }

  ?>
  <div class="container">
    <form id="contact" action=" " method="post">
      <h3>Patient Update Form</h3>
      <h4>Please fill out the form to help keep the patients data updated.</h4>
      <h4><?php echo "Visit Date: ".date("Y-m-d"); ?></h4>
      <fieldset>
        <input placeholder="height" type="text" tabindex="1" name = "insurance" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="weight:" type="text" name = "Reason" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="bloodtype:" type="text" name = "Reason" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Medications:" type="text" name = "Reason" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Allergies:" type="text" name = "Reason" tabindex="2" required>
      </fieldset>
      <h4>Next Appointment (If Any)</h4>
      <fieldset>
        <input placeholder="Primary Doctor:" type="date" name = "ReturnDate" tabindex="6" required>
      </fieldset>
      <fieldset>
        <input placeholder="Primary Care Location:" type="text" name = "ReturnLocation" tabindex="7" required>
      </fieldset>
      <fieldset>
        <button name="btn_submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
      </fieldset>
      <fieldset>
        <?php
          echo "".'<a class = "explore" href = "UpdateCoreInfo.php?updateCoreInfo='.$x.'">UpdateCoreInfo</a>'." ";
        ?>
      </fieldset>
    </form>
  </div>


  </body>
  </html>

<?php
if(isset($_POST['btn-sbm'])){

  $height = mysql_real_escape_string($_POST['height2']);
  $weight = (mysql_real_escape_string($_POST['weight2']));
  $bloodtype = (mysql_real_escape_string($_POST['bloodtype2']));
  $medications = (mysql_real_escape_string($_POST['medications2']));
  $allergies = (mysql_real_escape_string($_POST['allergies2']));
  $PDC = (mysql_real_escape_string($_POST['primaryDoctor2']));
  $PCL = (mysql_real_escape_string($_POST['primarylocation']));
  $problems = (mysql_real_escape_string($_POST['problems2']));
  $insurance = (mysql_real_escape_string($_POST['insurance2']));


  $sql = "INSERT INTO patientinfo (pid, height, weight, bloodtype, medications, allergies, primaryDoctor,
  PrimaryCareLocation, Insurance, problems)
  VALUES
  ('$x', '$height', '$weight', '$bloodtype', '$medications', '$allergies', '$PDC', '$PCL', '$problems',
  '$insurance')";
  mysqli_query($conn, $sql);
  echo "Data successfully updated";

}
}
?>
</body>
</html>
