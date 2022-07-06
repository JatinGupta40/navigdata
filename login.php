<?php 

require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/header.php';
require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/insert.php';
require_once($_SERVER['DOCUMENT_ROOT']) .'/navigdata/Classes/user.php';
$insert = new insertQuery\insert;
$user = new userQuery\user;
?>

<div id="Login">
   <div class="loginpage card bg-light">
      <article class="card-body mx-auto" style="max-width: 400px;">
         <h4 class="card-title mt-3 text-center">LOGIN</h4>
         <form action="signup.php" id="contactform" method="POST">
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
               </div>
               <input id="email" name="email" class="form-control" placeholder="Email address" type="email">
            </div>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
               </div>
               <input class="form-control" id="password" name="password" placeholder="Password" type="password">
            </div>
            <!-- form-group// -->
            <div class="form-group">
               <button type="submit" class="btn btn-primary btn-block" name="login" id="submit"> LOGIN </button>
            </div>
            <!-- form-group// -->      
         </form>
      </article>
   </div>
   <!-- card.// -->
</div>
<script>
// function openCity(evt, cityName) {
//   var i, tabcontent, tablinks;

//   tabcontent = document.getElementsByClassName("tabcontent");
//   for (i = 0; i < tabcontent.length; i++) {
//     tabcontent[i].style.display = "none";
//   }
//   tablinks = document.getElementsByClassName("tablinks");
//   for (i = 0; i < tablinks.length; i++) {
//     tablinks[i].className = tablinks[i].className.replace(" active", "");
//   }
//   document.getElementById(cityName).style.display = "block";
//   evt.currentTarget.className += " active";
// }

// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();
</script>


<?php include './footer.php'; ?>
</body>
</html>