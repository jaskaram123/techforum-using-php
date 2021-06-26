<?php
include'logics/dbconnect.php';
session_start();
$notlogin = false;
$category_id = $_GET['categid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['isloggedin'])) {
  $usernamerec = $_SESSION['username'];
  $thrdtitle = $_POST['thread_title'];
  $thrddesc = $_POST['thread_content'];

  $thrdtitle = str_replace("<", "&lt", $thrdtitle);
  $thrdtitle = str_replace(">", "&gt", $thrddesc);
  $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_categoryid`, `thread_username`, `dateadded`) VALUES ('$thrdtitle', '$thrddesc', '$category_id', '$usernamerec', current_timestamp());";
  $result = mysqli_query($conn, $sql);
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['isloggedin']) == false){
  $notlogin = true;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Techforums</title>
  </head>
  <body>
  <?php require 'presets/navbar.php';?>
<?php
// echo $login;

if ($notlogin == true) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Please login first</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
<?php
if (isset($_GET['n']) == true) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hello</strong> Welcome to the forum. Please signup.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['wrngpss']) == true) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Hey!</strong> You entered incorrect password. Please try again.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['o']) == true) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hello</strong> The username or email is already registered, try using another email.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['pssmtch']) == true) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Hey!</strong> Passwords donot match.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['corrt']) == true) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Welcome </strong> What you want to do today.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
<!-- Modal login-->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- the loging form -->
      <form action= "login.php?d=threads&categid=<?php echo $category_id?>" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name= 'username' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="user_pass" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Signup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- the signup form -->
      <form action="logics/signup.php?d=threads&categid=<?php echo $category_id?>" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name= 'username' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name= 'user_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="user_pass" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" name="cuser_pass" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>

</div>
<!-- navigation bar ends here -->
<div class="container my-4">
<?php
$category_id = $_GET['categid'];
$sql = "SELECT * FROM `categories` WHERE category_id LIKE '$category_id'";
$result = mysqli_query($conn, $sql);
$catdata = mysqli_fetch_assoc($result);

echo '<div class="alert alert-success" role="alert">
<h4 class="alert-heading">' . $catdata['category_name'] . '</h4>
<p>' . $catdata['category_desc'] . '</p>
<hr>
<p class="mb-0">No Spam / Advertising / Self-promote in the forums.
Do not post copyright-infringing material.
Do not post “offensive” posts, links or images.
Do not cross post questions.
Do not PM users asking for help.
Remain respectful of other members at all times</p>
</div>';
?>
<h1 style="color: #198754" class="text-center">Current Threads</h1>
<div class="container mb-5" id="ques">
<?php
    $sql = "SELECT * FROM `threads` WHERE thread_categoryid LIKE '$category_id'";
    $result = mysqli_query($conn, $sql);
while ($threaddata = mysqli_fetch_assoc($result)) {
    echo '<div class="media my-3">
    <div class="media-body">'.
     '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid=' . $threaddata['thread_id']. '&d=thread">'. $threaddata['thread_title'] . ' </a></h5>
        '. $threaddata['thread_desc'] . ' </div>'.'<div class="font-weight-bold my-0"> Asked by: '. $threaddata['thread_username'] . ' at '. $threaddata['dateadded']. '</div>'.
'</div>';
}
?>
</div>


<div class="new">
<h2 style="color: #198754">Start a new discussion</h2>
<form action="threads.php?d=threads&categid=<?php echo $category_id;?>" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name='thread_title' aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Describe your title</label>
    <textarea class="form-control" name='thread_content' placeholder="My issue is that..." id="exampleInputPassword1"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Initiate thread</button>
</form>
</div>
</div>

        <!-- form to add new category -->
        <h1 style="color: #198754" class="text-center">Join the community forum...</h1>
</div>
    <?php require 'presets/footer.php'; ?>
  </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>