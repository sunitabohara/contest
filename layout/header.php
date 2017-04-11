<?php
session_start();

$session_user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "User";
$session_user_id=isset($_SESSION['member_id']) ? $_SESSION['member_id']:"member_id";
?>
    <!DOCTYPE html>
<html>
    <head>
        <title>
            Contestent Management
        </title>
        <link rel="stylesheet" href="/../../contest/public/assets/css/bootstrap.min.css"><!-- 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

    </head>
<body class="bg-success">
    <div class="  navbar navbar-inverse" role="navigation">

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse">
                <ul  class="nav navbar-nav" >
                    <li><a href="/" >Home</a></li>
                    <li><a href="contestent"   class="dropdown-toggle" data-toggle="dropdown">Student <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="/contest/contestent/addedit.php?">Add</a></li>
                            <li><a href="/contest/contestent/">List</a></li>

                        </ul>
                    </li>

            </div>
        </div>
    </div>

    <div class="container">
<?php
     if(isset($_SESSION['error']) &&( $_SESSION['error'] == 1))
     {
         echo $_SESSION['error_message'];
         unset($_SESSION['error']);
         unset($_SESSION['error_message']);
     }

if(isset($_SESSION['success']) && $_SESSION['success'] == 1)
{
    echo $_SESSION['success_message'];
    unset($_SESSION['success']);
    unset($_SESSION['success_message']);
}
?>