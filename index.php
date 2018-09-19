<?php
require "back/class/Controller.php";
session_start();
if(!isset($_SESSION['Controller'])){
    $_SESSION['Controller'] = new Controller();
}

$_SESSION['Controller']->create();