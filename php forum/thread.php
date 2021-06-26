    <?php
    include'logics/dbconnect.php';
    $notlogin = false;
    $threadid = $_GET['threadid'];
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['isloggedin'])) {
        $comment = $_POST['comment'];
        $usernamerec = $_SESSION['username'];
        $comment = str_replace("<", "&lt", $comment);
        $comment = str_replace(">", "&gt", $comment);
        $sql = "INSERT INTO `comments` (`comment_text`, `comment_userid`, `comment_threadid`, `date`) VALUES ('$comment', '$usernamerec', '$threadid', current_timestamp());";
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
    <?php require 'presets/navbar.php'; 
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
  <strong>Hello</strong> The username or email is already registered, try using another username or email.
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
    <?php
// echo $login;

if ($notlogin == true) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Please login first</strong>
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
      <form action= "login.php?d=thread&threadid=<?php echo $threadid?>" method="post">
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
      <form action="logics/signup.php?d=thread&threadid=<?php echo $threadid?>" method="post">
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
<div class="container my-4">
<?php
$threadid = $_GET['threadid'];
$sql = "SELECT * FROM `threads` WHERE thread_id LIKE '$threadid'";
$result = mysqli_query($conn, $sql);
$threaddata = mysqli_fetch_assoc($result);

echo '<div class="alert alert-success" role="alert">
<h4 class="alert-heading">' . $threaddata['thread_title'] . '</h4>
<p>' . $threaddata['thread_desc'] . '</p>
<p>Asked by ' . $threaddata['thread_username'] . ' on ' . $threaddata['dateadded'] . '</p>

</div>';
?>

<h2 style="color: #198754" class="text-center">Comments on this thread</h2>
<?php
    $sql = "SELECT * FROM `comments` WHERE comment_threadid LIKE '$threadid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($commentdata = mysqli_fetch_assoc($result)) {
            echo '<div class="media my-3">
            <div class="media-body">
<strong>'. $commentdata['comment_userid'] . ' </strong>
            <p>'. $commentdata['comment_text'] . '</p>
            <p> On :'. $commentdata['date'] . '</p>
           
            </div>
            </div>';
    }
}
?>
</div>
<div class="container">
<div class="new">
<h2 style="color: #198754">Post a comment</h2>
<form action="thread.php?d=thread&threadid=<?php echo $threadid;?>" method="post">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Your thoughts on this</label>
    <textarea class="form-control" name='comment' placeholder="My issue is that..." id="exampleInputPassword1"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Post comment</button>
</form>
</div>
</div>
</div>

        <h1 style="color: #198754" class="text-center">Join the community forum...</h1>
</div>
    <?php require 'presets/footer.php'; ?>
  </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>