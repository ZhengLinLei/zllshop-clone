<?php
session_start();
//Require files
require_once "./controller/controller.php";
require_once "./model/model.php";

$mvc = new MVCcontroller();
$_SESSION["admin_security_token"] = rand();

if(!isset($_SESSION["admin"])){
    $mvc->include_template("login");
}else{
    $mvc->include_template("template");
}
