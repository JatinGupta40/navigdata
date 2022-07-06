<?php
  require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/header.php';
  require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/user.php';
  require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/method.php';
  $method = new methodQuery\method;
  $user = new userQuery\user;

  $data = $_POST;
  // Checking empty field
  if(empty($data['fname']) || empty($data['lname']) || empty($data['email']) || empty($data['password']) || empty($data['repassword'])) {
    // Email id present in DB or not.
    $user = $user->checkEmail($data['email']);
    if ($method->numRows($user) > 0) {
      $row = $method->fetchAssoc($user);
      // Email and pd fetched from db.
      $email = $row['email'];
      $password = $row['password'];
      // Validating Password.
      if ($email == "admin@gmail.com" && $password="21232f297a57a5a743894a0e4a801fc3") {
        $_SESSION['loggedin'] = true; 
        $_SESSION['id'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        header('location:blogs.php');
      }
      elseif (md5($data['password']) == $password) {
        $_SESSION['loggedin'] = true; 
        $_SESSION['email'] = $email;
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        header('location:blogs.php');
      }
      else {
        ?>
          <div class="alert alert-danger">
            <p>Email-Id or Password does not match</p>
          </div>
        <?php
        sleep(5);
        header('location:login.php');
      }
    }
  }

?>



<!-- //    if(isset($_POST['register']))
//   {
//   	//getting the post values
//     $fname=$_POST['fname'];
//     $lname=$_POST['lname'];
//     $email=$_POST['email'];
//     $password=$_POST['password'];
//    $repassword=$_POST['repassword'];
    
//    if($pass)
//   // Query for data insertion
//      $query=mysqli_query($con, "insert into tblusers(fname , lname, email, password) VALUES 
//      ('$fname','$lname', '$email', '$password' )");
//     if ($query) {
//     echo "<script>alert('You have successfully inserted the data');</script>";
//     echo "<script > document.location ='index.php'; </script>";
//   }
//   else
//     {
//       echo "<script>alert('Something Went Wrong. Please try again');</script>";
//     }
// } -->
