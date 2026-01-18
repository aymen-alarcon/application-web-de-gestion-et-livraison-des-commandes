<?php
namespace App\Controller;
class ViewsController{
    function RedirectToLoginPage(){
        require_once "src/Views/Login.php";
    }
}