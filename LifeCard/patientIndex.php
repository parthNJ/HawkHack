<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
  <link rel="stylesheet"  href="doctorindex.css" media="Screen" type = "text/css" >
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
          <li><a href="#"></span>Welcome Patient</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
        </ul>
      </div>
    </nav>
    </body>
    </html>





<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'lifecard');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$pid = $_SESSION['pid'];

$sql = "SELECT * FROM patientinfo WHERE pid='$pid'";

$result = mysqli_query($conn, $sql);
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


      $sql = "SELECT * FROM patientlogin Where pid='$pid'";
      $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
          while($row = mysqli_fetch_assoc($result)){
            $fname = $row["Fname"];
            $lname = $row["Lname"];
            $dob = $row["dob"];
            $address = $row["Address"];
            $ECN = $row["EmergencyContactName"];
            $EC = $row["EmergencyContact"];
          }
          ?>
          <div class = "box">
            <br><br><br>
             <img class = "image-profile" src="img/image-<?php echo $pid ?>.jpg" alt="Avatar" style="width:200px; height:200px;">
             <h2 class = "user-text">Patient Name: <?php echo $fname." ".$lname; ?></h2>
             <h2 class = "user-text">Patient DOB: <?php echo $dob; ?></h2>
             <h2 class = "user-text">Patient Address: <?php echo $address; ?></h2>
             <h2 class = "user-text">Emergency Contact: <?php echo $ECN; ?></h2>
             <h2 class = "user-text">Emergency Contact Phone#: <?php echo $EC; ?></h2>
           </div>
            <?php

        }
        echo "<hr>";
        ?>
        <details>
          <summary>Patient's Health Details</summary>
          <h2 class = "detaile_txt"><b>Patient's height: </b><?php echo $height ?></h2>
          <h2 class = "detaile_txt"><b>Patient's weight: </b><?php echo $weight ?></h2>
          <h2 class = "detaile_txt"><b>Patient's BloodType: </b><?php echo $bloodtype ?></h2>
          <h2 class = "detaile_txt"><b>Patient's current medications: </b><?php echo $medications ?></h2>
          <h2 class = "detaile_txt"><b>Patient's known allergies: </b><?php echo $allergies ?></h2>
          <h2 class = "detaile_txt"><b>Patient's current health conditions: </b><?php echo $problems ?></h2>
        </details>
        <?php

      echo "<hr>";

      ?>
      <details>
        <summary>Patient's Primary Care Location</summary>
        <h2 class = "detaile_txt"><b>Patient's Insurance: </b><?php echo $insurance ?></h2>
        <h2 class = "detaile_txt"><b>Patient's Primary Doctor: </b><?php echo $primaryDoctor ?></h2>
        <h2 class = "detaile_txt"><b>Patient's Primary Care Location: </b><?php echo $primaryCareLocation ?></h2>
      </details>
      <?php

     echo "<hr>";
    }
  }

  $sql2 = "SELECT doctortable.Fname, doctortable.Lname,
    doctortable.doctorAddress, doctortable.doctorPhone, patientvisit.Visitdate,
    patientvisit.visitInfo, patientvisit.symptomps, patientvisit.testInfo,
    patientvisit.perscriptions, patientvisit.nextAppointmenetDate,
    patientvisit.nextAppointmentLocation
       FROM doctortable
       INNER JOIN patientvisit
       ON patientvisit.doctorID=doctortable.doctorID
       WHERE patientvisit.pid= '$pid'";

       $result2 = mysqli_query($conn, $sql2);
       if(mysqli_num_rows($result2) >= 1){
         ?>
         <h2 class ="aboutMe-IntoTxt">Patient's Past Health Record</h2>
         <br><br>
           <?php
           $temp = 0;
         while($row = mysqli_fetch_assoc($result2)){
           //Doctor stuff
           $DoctorFname =  $row["Fname"];
           $DoctorLname =  $row["Lname"];
           $DoctorAddress =  $row["doctorAddress"];
           $DoctorPhone =  $row["doctorPhone"];

           //Patient Stuff
           $visitdate =  $row["Visitdate"];
           $visitInfo =  $row["visitInfo"];
           $symptomps =  $row["symptomps"];
           $perscriptions =  $row["perscriptions"];
           $testInfo =  $row["testInfo"];
           $Visitdate =  $row["Visitdate"];
           $nextAppointmenetDate =  $row["nextAppointmenetDate"];
           $nextAppointmentLocation =  $row["nextAppointmentLocation"];
           $temp = $temp +1;
           ?>


           <div class="box2">
             <h2 class = "detaile_txt2"><b>Visit: </b><?php echo $temp; ?></h2>
               <h2 class = "detaile_txt2"><b>Doctor Name: </b> Dr.<?php echo $DoctorFname; ?></h2>
               <h2 class = "detaile_txt2"><b>VisitDate: </b><?php echo $visitdate; ?></h2>
               <h2 class = "detaile_txt2"><b>Reason For Visit: </b><?php echo $visitInfo; ?></h2>
               <h2 class = "detaile_txt2"><b>Patient's Sysmptoms: </b><?php echo $symptomps; ?></h2>
               <h2 class = "detaile_txt2"><b>Tests performed: </b><?php echo $testInfo; ?></h2>
               <h2 class = "detaile_txt2"><b>Given perscriptions: </b><?php echo $perscriptions; ?></h2>
               <h2 class = "detaile_txt2"><b>Follow-Up appointment on: </b><?php echo $nextAppointmenetDate; ?></h2>
               <h2 class = "detaile_txt2"><b>Follow up Appointment location: </b><?php echo $nextAppointmentLocation; ?></h2>
               <br><br>
               </div>
               <br><br><br>
           <?php
         }
     }

 ?>



</body>
</html>
