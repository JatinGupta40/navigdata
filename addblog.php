<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/header.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/method.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/blog.php');
    $blog = new blogQuery\blog;
    $user = new userQuery\user;
    $method = new methodQuery\method;

    $a = $_SESSION['fname'];
    $id = $_SESSION['id'];
  
    // Form Validation.
    if(isset($_POST['submit']))
    {
      $heading = $_POST['heading'];
      $content = $_POST['content'];
      $comment = $_POST['comment'];

      if(!empty($_POST['heading']))
      {
        $heading = $_POST['heading'];
      }
      else 
      {
        $heading == null;
      }
      if(!empty($_POST['content']))
      {
        $content = $_POST['content']; 
      }
      else 
      {
        $content == null;
      }
      if(!empty($_POST['comment']))
      {
        $comment = $_POST['comment']; 
      }
      else 
      {
        $comment == null;
      }
      $result = $blog->insertBlog($id, $heading, $content, $comment);
    }
?>

<div class="addblog">
  <div class="container d-flex align-items-center createblog">
    <form method="POST" style="width:50%">
      <h3 class="form-caption">Add Blog</h3>
      <hr>
      <div class="form-group">
        <label>Title/Heading</label>
        <input type="title" name="heading" class="form-control" placeholder="Enter Title" required>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea type="content" name="content" rows="8" class="form-control" placeholder="Blog Content" required></textarea>
      </div>
      <div class="form-group">
        <b><i><label for="comment">Please provide your valuable comment : </label></i></b>
        <textarea type="comment" name="comment" rows="3" class="form-control" placeholder="Comment Here" required></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<?php include 'footer.php' ?>
