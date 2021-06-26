<?php
$directory = $_GET['d'];
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
session_start();
session_destroy();
session_abort();
header('Location: https://jaskaram.000webhostapp.com/' . $directory . '.php?d=' . $directory . '&' . $var . '=' . $category_id . '&' . $searching . '=' . $search);
?>