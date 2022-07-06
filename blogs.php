<?php

require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/header.php');
require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/user.php');
require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/method.php');
require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/blog.php');
$blog = new blogQuery\blog;
$user = new userQuery\user;
$method = new methodQuery\method;

// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
  <div class="container">
    <div class="addblog">
      <h2><a href="addblog.php">Add Blog</a></h2>
      <hr>
    </div>
    <div class="myblog">
      <h2><u>My Blogs</u><i class="fas fa-caret-down"></i></h2>
    </div>
  </div>

<?php
  // To Check who is visiting page, random or admin.
  if(isset($_SESSION['email']) == "admin@gmail.com" || isset($_SESSION['email']) == '') {
    // Fetching ell the blogs from the blog table.
    $adminQuery = $blog->blog();
    // If table have some data.
    if($adminQuery->num_rows > 0) {
      // Here, fetch function is called from source file and method class.
      while($row = $method->fetchAssoc($adminQuery)) {
        // Fetching details from DB
        $id = $row['id'];
        $heading = $row['Heading'];
        $content = $row['content'];
?>
        <div class="blogbox">
          <h3><?php echo $heading; ?></h3>
          <p>
<?php
          // Trimming down the content to 150 words only.
            $content = substr($content, 0, 200); 
            echo $content . '....';
?>
          </p>
          <p>
            <div class="vieweditdelete">
              <div class="vieweditdeletebutton">
                <a href="article.php?Heading=<?php echo $heading; ?>&id=<?php echo $id;?>"><button type="submit" class="" name="submit"> View </button></a>
              </div>    
              <div class="vieweditdeletebutton">
                <a href="editblog.php?id=<?php echo $id;?>">
                <button type="submit"  class="" name="submit"> Edit </button></a>
              </div>
              <div class="vieweditdeletebutton">
                <a href="deleteblog.php?Heading=<?php echo $heading; ?>&id=<?php echo $id;?>"><button type="submit" class="" name="submit"> Delete </button></a>
              </div>
            </div>  
          </p>
        </div>
      <?php
      }
    }
    else {
      ?>
      <div class="">
        <h5>You have not added any Blog yet.</h5>
        <p>(To create, click on the Add Blog button above.)</p>
      </div>
    <?php        
    }
  }
  else {
    $email = isset($_SESSION['email']);
    // For accessing the id of the logged in user to be used as reference for getting Heading and content data to be fetched from the blog table.
    // Checking the logged in user is registered user and not is not an  admin.
    $userquery = $user->checkEmail($email);
    if ($userquery->num_rows > 0) {
      while ($row1 = $method->fetchAssoc($userquery)) { 
        // Id fetching from DB table of user.
        $id = $row1['id']; 
        $_SESSION['fname'] = $row1['fname'];
        $_SESSION['id'] = $row1['id'];
      }
    }
        
    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } 
    else { 
      $pageno = 1;
    }

    // Number of blogs to be shown on a single page.
    $no_of_records_per_page = 5;  
    $offset = ($pageno-1) * $no_of_records_per_page;
    if ($offset > 0) {  
      // Counting the number of blogs user have of his own.
      $result = $blog->countBlog($id); // Mapping it to db.
      $total_rows = $method->fetchAssoc($result)[0];

      // Total number of pages to be made with respect to 5 blogs per page.
      $total_pages = ceil($total_rows / $no_of_records_per_page);  // The ceil function round off the value.
            
      // Fetching data from DB table blog.
      $result = $blog->selectBlog($id, $offset, $no_of_records_per_page);
      if ($result->num_rows > 0) {
        while ($row = $method->fetchAssoc($result)) {
          $heading = $row['Heading'];
          $content = $row['content'];
          $_SESSION['heading'] = $row['Heading'];
          $id = $row['id'];
    ?>
          <div class="" style="margin-top:20px;">
            <div class="blogbox">
              <h3><?php echo $heading; ?></h3>
              <p>
                <?php { echo $content; } ?>
                <div class="editdelete">
                  <div class="editdeletebutton">
                    <a href="article.php?Heading=<?php echo $heading; ?>&id=<?php echo $id;?>"><button type="submit" class="" name="submit"> View </button></a>
                  </div>    
                  <div class="editdeletebutton">
                    <a href="editblog.php?id=<?php echo $id;?>">
                    <button type="submit"  class="" name="submit"> Edit </button></a>
                  </div>
                  <div class="editdeletebutton">
                    <a href="deleteblog.php?Heading=<?php echo $heading; ?>&id=<?php echo $id;?>"><button type="submit" class="" name="submit"> Delete </button></a>
                  </div>
                </div>
              </p>
            </div>
          </div>
      <?php
        }
      }
    }
    else {
      ?>
      <div class="">
        <h5>You have not added any Blog yet.</h5>
        <p>(To create, click on the '<u>Add Blog</u>' button above.)</p>
      </div>
      <?php
    }
  }
?>
<?php include 'footer.php';