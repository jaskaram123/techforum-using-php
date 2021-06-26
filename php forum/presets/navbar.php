<?php
$var = '';
$category_id = '';
$search = '';
$searching = '';

      if (isset($_GET['categid'])) {
        $category_id = $_GET['categid'];
        $var = 'categid';
    }
    if (isset($_GET['threadid'])) {
        $category_id = $_GET['threadid'];
        $var = 'threadid';
    }
    if (isset($_GET['search_query'])) {
        $search = $_GET['search_query'];
        $searching = 'search_query';
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Techforums...</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?d=index" tabindex="-1" aria-disabled="true">Categories</a>
        </li>
      </ul>
      <form class="d-flex" action= '\php forum/search.php' method='get'>
      <input type="hidden" name="d" value= 'search'>
      <input type="hidden" name="<?php echo $var ?>" value= '<?php echo $category_id;?>'>
        <input class="form-control me-2" type="search" name='search_query' placeholder="Search" aria-label="Search">
        <button class="btn btn-light mx-2" type="submit">Search</button>
      </form>
      <?php

      if (isset($_SESSION['isloggedin']) && isset($_SESSION['username'])) {
        echo '<button type="button" class="btn btn-outline-success" style= "background-color: white; color: green; font-weight: 800"><a href="logics/logout.php?d=' . $_GET['d'] .'&' . $var . '=' . $category_id . '&' . $searching . '=' . $search . '">Logout</a></button>';
      }else {
        echo '<button type="button" class="btn btn-outline-success" style= "background-color: white; color: green; font-weight: 800"  data-bs-toggle="modal" data-bs-target="#login">Login</button>
        <button type="button" class="btn btn-outline-success" style= "background-color: white; color: green; font-weight: 800" data-bs-toggle="modal" data-bs-target="#signup">Signup</button>';
      }
      ?>
      
    </div>
  </div>
</nav>