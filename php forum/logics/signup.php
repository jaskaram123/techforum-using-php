<?php
$olduser = false;
$match = true;
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
    include 'dbconnect.php';
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $cuser_pass = $_POST['cuser_pass'];

    if ($user_pass == $cuser_pass) {
        $passhash = password_hash($user_pass, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM `users` WHERE user_email= '$user_email'";
        $result = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM `users` WHERE username= '$username'";
        $result = mysqli_query($conn, $sql);
        $number2 = mysqli_num_rows($result);
        if ($number == 0 && $number2 == 0) {
            $sql = "INSERT INTO `users` (`username`, `user_email`, `user_pass`, `date_joined`) VALUES ('$username', '$user_email', '$passhash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            session_start();
            $_SESSION['isloggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location:  \php forum/' . $directory . '.php?corrt=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
        }else {
            $olduser = true;
            header('Location: \php forum/' . $directory . '.php?o=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
        }
        
    }else {
        $match = false;
        header('Location: \php forum/' . $directory . '.php?pssmtch=true&d='. $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
    }
}

?>