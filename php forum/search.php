<?php 
include'logics/dbconnect.php';
session_start();
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
    <?php require 'presets/navbar.php'; ?>
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
  <strong>Hello</strong> The email is already registered, try using another email.
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


      <form action= "login.php?d=search&search_query=<?php echo $_GET['search_query'];?>" method="post">
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
<hr>


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
      <form action="logics/signup.php?d=search&search_query=<?php echo $_GET['search_query'];?>" method="post">
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
        <h1 class="text-center" style="color: #198754">Search results for <?php echo $_GET['search_query']?></h1>
        <!-- cards container grid -->

        <?php
        $query = $_GET['search_query'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num >0) {
        while ($threaddata = mysqli_fetch_assoc($result)) {
            echo '<div class="media my-3">
            <div class="media-body">'.
             '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid=' . $threaddata['thread_id']. '&d=thread">'. $threaddata['thread_title'] . ' </a></h5>
                '. $threaddata['thread_desc'] . ' </div>'.'<div class="font-weight-bold my-0"> Asked by: '. $threaddata['thread_username'] . ' at '. $threaddata['dateadded']. '</div>'.
        '</div>';
        }
    }
    else {
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">No Results found</h4>
        <p>Make a new thread by logging in.</p>
        <hr>
        <p class="mb-0">No such results found in the source.</p>
      </div>';
    }
?>



        <div class="row">
        <h1 style="color: #198754" class="text-center">Join the community forum...</h1>
</div>
    <?php require 'presets/footer.php'; ?>
  </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>