<?php
namespace App\Controller;
class ViewsController{
    function redirectToLoginPage(){
        require_once "src/Views/Login.html";
    }

    function redirectToAdminDashboard(){
        require_once "src/Views/admin/admin_dashboard.php";
    }

    function redirectToClientDashboard(){
        require_once "src/Views/client/client_dashboard.php";
    }

    function redirectToDelivererDashboard(){
        require_once "src/Views/deliverer/deliverer_dashboard.php";
    }

    function RedirectToLogOutPage(){
        require_once "src/Views/logout.php";
    }
}