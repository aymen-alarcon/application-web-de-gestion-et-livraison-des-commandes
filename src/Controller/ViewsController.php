<?php
namespace App\Controller;
echo 1;
class ViewsController{
    function RedirectToLoginPage(){
        require_once "src/Views/Login.php";
    }
}