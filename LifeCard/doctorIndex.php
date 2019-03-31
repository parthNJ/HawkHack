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
          $_SESSION['Lname'] = $doctorLname;
        }
      }
      ?>
      <li><a href="#"></span><?php echo "Welcome Dr. ".$doctorLname; ?></a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    </ul>
  </div>
</nav>
<img src = "img/scan.jpg" class ="image-move">
<form method = "post" action = "">
    <button type="submit" name = "randomize_btn" class="btn btn-lg btn-primary btn-block" >
        Scan Patient Card
    </button>
     </div>
    </div>
</form>
</body>
</html>


      <?php
    if(isset($_POST['randomize_btn'])){
      $randomPID = rand(1,6);

    $sql = "SELECT * FROM patientlogin Where pid='$randomPID'";
    $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
          $fname = $row["Fname"];
          $lname = $row["Lname"];
          $dob = $row["dob"];
          $Address = $row["Address"];
          $ECN = $row["EmergencyContactName"];
          $EC = $row['EmergencyContact'];
          ?>
          <div class = "box">
            <br><br><br>
          <img class = "image-profile" src="img/image-<?php echo $randomPID ?>.jpg" alt="Avatar" style="width:200px; height:200px;">
            <h2 class = "user-text">Patient Name: <?php echo $fname. " ".$lname;?><br></h2>
            <h2 class = "user-text">Patient DOB: <?php echo $dob;?><br></h2>
            <h2 class = "user-text">Patient Address: <?php echo $Address;?><br></h2>
            <h2 class = "user-text">Emergency Contact: <?php echo $ECN;?><br></h2>
            <h2 class = "user-text">Emergency Contact Name: <?php echo $EC;?><br></h2>


          <?php
          echo "<div class='button'>".'<a class = "explore" href = "updateForm.php?update='.$randomPID.'">Update LifeCard</a>'." </div>";
          echo "<div class='button1'>".'<a class = "explore" href = "LifeCard.php?view='.$randomPID.'">View LifeCard</a>'."</div>";
          echo "<br><br></div><br>";
        }
      }
    }


     if(isset($_GET['returnBack'])){
       $returnPID = ((int)$_GET['returnBack']);
       $sql = "SELECT * FROM patientlogin Where pid='$returnPID'";
       $result = mysqli_query($conn, $sql);
         if(mysqli_num_rows($result) == 1){
           while($row = mysqli_fetch_assoc($result)){
             $fname = $row["Fname"];
             $lname = $row["Lname"];
             $dob = $row["dob"];
             $Address = $row["Address"];
             $ECN = $row["EmergencyContactName"];
             $EC = $row['EmergencyContact'];

             ?>
             <div class = "box">
               <br><br><br>
             <img class = "image-profile" src="img/image-<?php echo $returnPID ?>.jpg" alt="Avatar" style="width:200px; height:200px;">
               <h2 class = "user-text">Patient Name: <?php echo $fname. " ".$lname;?><br></h2>
               <h2 class = "user-text">Patient DOB: <?php echo $dob;?><br></h2>
               <h2 class = "user-text">Patient Address: <?php echo $Address;?><br></h2>
               <h2 class = "user-text">Emergency Contact: <?php echo $ECN;?><br></h2>
               <h2 class = "user-text">Emergency Contact Name: <?php echo $EC;?><br></h2>


             <?php
             echo "<div class='button'>".'<a class = "explore" href = "updateForm.php?update='.$returnPID.'">Update LifeCard</a>'." </div>";
             echo "<div class='button1'>".'<a class = "explore" href = "LifeCard.php?view='.$returnPID.'">View LifeCard</a>'."</div>";
             echo "<br><br></div><br>";

           }
     }
    }

 ?>
