<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'lifecard');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['btn'])){
  $email = mysql_real_escape_string($_POST['email']);
  $password = (mysql_real_escape_string($_POST['password']));


  $sql = "SELECT * FROM login Where email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 1){
      while($row = mysqli_fetch_assoc($result)){
          if($row['email'] == $email && $row['password']==$password){
            $type = $row["type"];

            $pid = $row["pid"];
  	        $_SESSION['pid'] = $pid;

            $doctorId = $row["doctorID"];
            $_SESSION['doctorID'] = $doctorId;


            if($type == 1){
              header('location:doctorIndex.php');
            }
            else{
              header('location:patientIndex.php');
            }
          }

      else{
      echo "<h1>incorrect username and password</h1>";
      }
  }
  }
}

//register

if(isset($_POST['register_btn'])){
  $Fname = mysqli_real_escape_string($_POST['fname']);
  $Lname = mysqli_real_escape_string($_POST['lname']);
  $Email = mysqli_real_escape_string($_POST['email']);
  $pass = mysqli_real_escape_string($_POST['password']);
  $pass2 = mysqli_real_escape_string($_POST['password2']);
  if($pass != $pass2){
      echo "Sorry Passwords don't match";
  }
  else{
  $sql = "INSERT INTO patientlogin (Fname, Lname, Email, password) VALUES ('$Fname', '$Lname', '$Email', '$pass')";

  if(mysqli_query($conn, $sql)){
      header('location:re-login.php');
  }
  else{
      echo "Error try again";
  }
  }
  mysqli_close($conn);
}





?>
