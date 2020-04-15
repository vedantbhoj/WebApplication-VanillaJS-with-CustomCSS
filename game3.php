<?php include 'mycookie.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>The Game Store</title>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="./css/mystyle.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">

    <script>
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            if (sessionStorage.getItem("username") === null) {
                $("#add_usr_bar").show();
                $("#login_bar").show();
                $("#loggedin_user").hide();
                $("#username").hide();
            }
            else {
                $("#add_usr_bar").hide();
                $("#loggedin_user").show();
                $("#username").show();
                $("#username").html("Hi " + sessionStorage.getItem("username"));
                $("#login_bar").hide();
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <ul class="menu">
                <li class="menu-item" style="margin-top:5px;"><a><i style="font-size: 50px;" class="fa fa-gamepad fa-lg"></i></a></li>
                <li class="menu-item"><span class="title">  Vedant's Game Store - The best games just for you !!!</span></li>
                <ul class="menu-right">
                    <li class="menu-item"><a data-toggle="tooltip" data-placement="bottom" title="Home" href="index.php" id="home_bar"><i class="fa fa-home fa-lg"></i></a></li>
                    <li class="menu-item"><a data-toggle="tooltip" data-placement="bottom" title="Leader Board" href="javascript:void(0)" id="leader_bar"><i class="fa fa-trophy fa-lg"></i></a></li>
                    <li class="menu-item" id="add_usr_bar"><a data-toggle="tooltip" data-placement="bottom" title="Register" href="javascript:void(0)"><i class="fa fa-user-plus fa-lg"></i></i></a></li>
                    <li class="menu-item" id="login_bar"><a data-toggle="tooltip" data-placement="bottom" title="Sign In" href="./login.html" id="signin_usr_bar"> <span>Login <i class="fa fa-sign-in-alt fa-lg"></i></span></a></li>
                    <li class="menu-item" id="username" style="margin-right: -35px;font-size: 15px; display:none; color: white;font-family: cursive;"></li>
                    <li id="loggedin_user" class="menu-item" style="display:none;">
                        <span class="welcome-user">
                            <div class="dropdown">
                                <button class="dropbtn">
                                    <span><img id="onMe" class="img avatar" src="./images/user.jpg" /></span>
                                </button><div class="dropdown-content">
                                    <a href="#">Profile</a>
                                    <a href="#">History</a>
                                    <a href="#">Settings</a>
                                    <a href="#" onclick="logout()">Logout</a>
                                    <div id="ddpp"></div>

                                </div>
                            </div>
                            <label id="myName" style="color:#fff; font-size:18px;"></label>
                        </span>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="content">
            <div class="tabs">
                <ul class="tab-links ul">
                    <li class="li active"><a class="tab" href="javascript:void(0)">Need for Speed</a></li>
                    <li id="cart"><a><i class="fa fa-cart-plus active" style="float:right;font-size:35px;"></i></a><a style="padding:19px 58px 11px 13px">MY CART</a></li>
                    <li class="li active" style="float:right"><a class="tab hvr-shutter-out-horizontal" href="index.php">Go Back</a></li>
                </ul>

                <div class="tab-content">
                    <div id="Main_tab" class="tb_act">
                        <div class="page_container" id="dvdcover" style="width:420px;box-shadow: 0px 0px 3px 5px #B0BEC5;">
                        <div class="scroll" style=" background: url(./images/covers/gamecover3.jpg); -webkit-background-size: 100% 100%;">
                        </div>
                        </div>
                        <div class="page_container" id="GameDescDiv" style="width:760px;float:right;box-shadow: 0px 0px 3px 5px #B0BEC5;">
                            <div class="scroll" style="padding: 15px 20px 0 30px;">
                                <b>Product Description:</b>
                                <br><br>
                                    <p>
                               Need for Speed (NFS) is a racing video game franchise published by Electronic Arts and developed by Ghost Games. The series centers around illicit street racing and in general tasks players to complete various types of races while evading the local law enforcement in police pursuits. The series released its first title, The Need for Speed in 1994. The most recent game, Need for Speed Payback, was released on November 10, 2017.

The series has been overseen and had games developed by multiple notable teams over the years including EA Black Box and Criterion Games, the developers of Burnout.[1] The franchise has been critically well received and is one of the most successful video game franchises of all time, selling over 150 million copies of games.[2] Due to its strong sales, the franchise has expanded into other forms of media including a film adaptation and licensed Hot Wheels toys.[3]
                                    </p>
                                <br>
                                <b>Price:</b> &nbsp&nbsp&nbsp<span>$200</span>
                                <br>
                                <button  class="btn">Add to Cart</button>
                                <button  class="btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
