<?php
session_start();
require('library.php');

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    echo $id, $name;
} else {
    header('Location: login.php');
    exit();
}
?>

ログイン完了