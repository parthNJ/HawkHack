<?php
session_start();
$doctorId = $_SESSION['doctorID'];
if($doctorId==''){
  header('location:login.php');
}

$conn = mysqli_connect('localhost', 'root', '', 'lifecard');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 $doctorId = $_SESSION['doctorID'];

if(isset($_GET['update'])){
  $x = ((int)$_GET['update']);
}
 ?>
<!DOCTYPE html>
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
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">LifeCard</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Scan Patient</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
    <?php


          $sql1= "SELECT doctortable.Fname, doctortable.Lname, doctortable.type
               FROM login
               INNER JOIN doctortable
               ON login.doctorId=doctortable.doctorId
               WHERE doctortable.doctorId = '$doctorId'";

              $result = mysqli_query($conn, $sql1);
                if(mysqli_num_rows($result) == 1){
                  while($row = mysqli_fetch_assoc($result)){
                    $doctorFname = $row["Fname"];
                    $doctorLname = $row["Lname"];

                  }
                }
                ?>
                <li><a href="#"></span><?php echo "Welcome Dr. ".$doctorLname; ?></a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
              </ul>
            </div>
        </nav>
<?php
echo "<h3 class = 'centered'>".'<a class = "explore" href = "doctorindex.php?returnBack='.$x.'">BackToHome</a>'."</h3> ";

if(isset($_POST['btn_submit'])){
  $pid = $x;
  $doctorID = $_SESSION['doctorID'];
  //$dateVisit  = mysql_real_escape_string($_POST['visitDate']);
  $dateVisit = date("Y-m-d");
  $reasonForVisit  = mysql_real_escape_string($_POST['Reason']);
  $symptomps = mysql_real_escape_string($_POST['symptomps']);
  $perscriptions =  mysql_real_escape_string($_POST['perscriptions']);
  $tests = mysql_real_escape_string($_POST['tests']);
  $ReturnDate = mysql_real_escape_string($_POST['ReturnDate']);
  $ReturnLocation = mysql_real_escape_string($_POST['ReturnLocation']);

  $sql = "INSERT INTO patientvisit (pid, doctorID, visitinfo, symptomps, perscriptions, testInfo, Visitdate, nextAppointmenetDate,nextAppointmentLocation)
  VALUES ('$pid', '$doctorID', '$reasonForVisit','$symptomps' ,'$perscriptions', '$tests', '$dateVisit', '$ReturnDate', '$ReturnLocation')";


  if(mysqli_query($conn, $sql) == TRUE){
    echo "<h3 class = 'centered'>Data successfully updated</h3>";
  }
  else{
    echo "data not updated properly";
  }

}

$sql = "SELECT * FROM patientlogin Where pid='$x'";
$result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) == 1){
    while($row = mysqli_fetch_assoc($result)){
      $fname = $row["Fname"];
      $lname = $row["Lname"];
    }
  }
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<div class="container">
  <form id="contact" action=" " method="post">
    <h3>Patient Update Form</h3>
    <h4>Please fill out the form to help keep the patients data updated.</h4>
    <h4><?php echo "Visit Date: ".date("Y-m-d"); ?></h4>
    <h4><?php echo "Patient Name: ".$fname." ".$lname ?></h4>
    <fieldset>
      <input placeholder="Insurance:" type="text" tabindex="1" name = "insurance" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Reason for visit:" type="text" name = "Reason" tabindex="2" required>
    </fieldset>
    <fieldset>
      <textarea placeholder="Symptomps: " name = "symptomps" tabindex="3" required></textarea>
    </fieldset>
    <fieldset>
      <textarea placeholder="Performed Tests: " name = "tests" tabindex="4" required></textarea>
    </fieldset>
    <fieldset>
      <textarea placeholder="Perscribed medicine: " name = "perscriptions" tabindex="5" required></textarea>
    </fieldset>
    <h4>Next Appointment (If Any)</h4>
    <fieldset>
      <input placeholder="Next Appointment(IfAny):" type="date" name = "ReturnDate" tabindex="6" required>
    </fieldset>
    <fieldset>
      <input placeholder="Appointment location:" type="text" name = "ReturnLocation" tabindex="7" required>
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
