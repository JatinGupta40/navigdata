<?php 

require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/header.php';
require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/insert.php';
require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/user.php';
$insert = new insertQuery\insert;
$user = new userQuery\user;

  if (isset($_POST['submit'])) {
    $data = [
        'fname' => $_POST['fname'], // Post fname is coming from the UI and getting stored into fname.
        'lname'=> $_POST['lname'],
        'email' => $_POST['email'],
        'pass' => $_POST['password'],
        'repass' => $_POST['repassword'],
      ];
      // Validation.
      if (!empty($data['fname'])) {
        $fname = htmlspecialchars($data['fname']);
      }
      else {
        $fname = null;
      }
      
      if (!empty($data['lname'])) {
        $lname = htmlspecialchars($data['lname']);
      }
      else {
        $lname = null;
      }
    
      if (!empty($data['email'])) { 
        $email = htmlspecialchars($data['email']);
      }
      else {
        $email = null;
      }
   
      if (!empty($data['pass'])) {
        $password = htmlspecialchars($data['pass']);
      } 
      else {
        $password = null;
      }
   
      if (!empty($data['repass'])) {
        $repassword = htmlspecialchars($data['repass']);
      }
      else {
        $repassword = null;
      }
     
      $errors = array();
      if($fname == null) {
        $errors['fname'] = 'Fname is required.';
      }

      if($lname == null) {
        $errors['lname'] = 'Lname is required.';
      }

      if ($email == null) {
        $errors['email'] = 'Email-Id is required.';
      }
      else {
        if($password == null) {
          $errors['pass'] = 'Password is required.';
        }
        elseif($repassword == null) {
          $errors['repass'] = 'Confirm Password is required.';
        }
        elseif($password != null && $repassword != null) { 
          if($password != $repassword) {
            $errors['check'] = 'Password and Confirm Password does not matched.';
          }
          else {
            // Checking the entered email id with the existing email id's.
            $sql = $user->checkEmail($email);
            if(!empty($sql)) {
              $row = $method->numRows($sql);
              if($row >=  1) {
                $errors['email'] = 'This email id is already taken';
              }
            }
          }
        }
      }

      // Register User.
      if(!count($errors)>0) { 
        $date = date("d-m-Y");
        date_default_timezone_set("Asia/Calcutta");
        $time = date("h-ia");
        if($insert->insertUserDetails($fname, $lname, $email, md5($password), $date, $time)) {
          $alert = true;
          $_SESSION['fname'] = $fname;
          $_SESSION['lname'] = $lname;
          $_SESSION['email'] = $email;
          $_SESSION['password'] = $password;
          $_SESSION['date'] = $date;
          $_SESSION['time'] = $time;
          $success = true;
          $_SESSION['success'] = $success;
          header('location:index');
        }
        else {       
          $errors['check'] = 'Registration failed. Please check your Credentials';
        }
      }
    }
?>

<div id="Registration">
  <div class="registrationpage card bg-light ">
    <?php 
      if (isset($errors)) {
        if (count($errors) > 0) {
          foreach ($errors as $key => $value) {
            echo '<div class="alert alert-warning">' . $value . '</div>';
          }
        }
      }
    ?>
    <article class="card-body mx-auto">
      <h4 class="card-title mt-3 text-center">Create Account</h4>
        <form method="POST">
          <div class=" form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input id="fname" name="fname" class="form-control <?php if(isset($errors['check']) || isset($errors['fname'])) : ?>input-error<?php endif; ?>" placeholder="First name" value="<?php if(isset($_POST['fname'])) {echo $fname; } ?>" type="text" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input id="lname" name="lname" class="form-control <?php if(isset($errors['check']) || isset($errors['fname'])) : ?>input-error<?php endif; ?>" placeholder="Last name" value="<?php if(isset($_POST['fname'])) {echo $lname; } ?>" type="text" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input id="email" name="email" class="form-control <?php if(isset($errors['check']) || isset($errors['fname'])) : ?>input-error<?php endif; ?>" placeholder="Email address" value="<?php if(isset($_POST['fname'])) {echo $email; } ?>" type="email" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control <?php if(isset($errors['check']) || isset($errors['fname'])) : ?>input-error<?php endif; ?>" id="password" name="password" placeholder="Create password" value="<?php if(isset($_POST['fname'])) {echo $password; } ?>" type="password" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control <?php if(isset($errors['check']) || isset($errors['fname'])) : ?>input-error<?php endif; ?>" id="repassword" name="repassword" placeholder="Repeat password" value="<?php if(isset($_POST['fname'])) { echo $repassword; } ?>" type="password" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit" id="submit">Create Account</button>
          </div>
          <p class="text-center">Have an account? <a href = "login.php" class="tablinks text-primary" style="cursor:pointer;"><u><b>Login <b></u></a></p>
        </form>
    </article>
  </div>
  <!-- card.// -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>    
<script src="/vendors/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="/vendors/formvalidation/dist/js/plugins/Tachyons.min.js"></script>
<script>
   // function openpage(evt, tabname) {
   //   var i, tabcontent, tablinks;
   
   //   tabcontent = document.getElementsByClassName("tabcontent");
   //   for (i = 0; i < tabcontent.length; i++) {
   //     tabcontent[i].style.display = "none";
   //   }
   //   tablinks = document.getElementsByClassName("tablinks");
   //   for (i = 0; i < tablinks.length; i++) {
   //     tablinks[i].className = tablinks[i].className.replace(" active", "");
   //   }
   //   document.getElementById(tabname).style.display = "block";
   //   evt.currentTarget.className += " active";
   // }   
   // // Get the element with id="defaultOpen" and click on it
   // document.getElementById("defaultOpen").click();
</script>
<!-- <script src="../js/validation.js"></script> -->
<?php include './footer.php'; ?>