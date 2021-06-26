<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = '';
$searching = '';
    $directory = $_GET['d'];
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
    include 'logics/dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['user_pass'];

    $sql = "SELECT * FROM `users` WHERE username= '$username'";
    $result = mysqli_query($conn, $sql);
    $number = mysqli_num_rows($result);
    if ($number == 1) {
        $data = mysqli_fetch_assoc($result);
        $datapass = $data['user_pass'];
        $verification = password_verify($password, $datapass);
        if ($verification) {
            session_start();
            $_SESSION['isloggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: ' . $directory . '.php?corrt=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
        }else {
            header('Location: ' . $directory . '.php?wrngpss=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
        }
    }
    elseif ($number == 0) {
        header('Location: ' . $directory . '.php?n=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
    }
}

?>