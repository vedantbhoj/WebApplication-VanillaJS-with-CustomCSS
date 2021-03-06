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
                    <li class="li active"><a class="tab" href="javascript:void(0)">FIFA 2017 - Ultimate Edition</a></li>
                    <li id="cart"><a><i class="fa fa-cart-plus active" style="float:right;font-size:35px;"></i></a><a style="padding:19px 58px 11px 13px">MY CART</a></li>
                    <li class="li active" style="float:right"><a class="tab hvr-shutter-out-horizontal" href="index.php">Go Back</a></li>
                </ul>

                <div class="tab-content">
                    <div id="Main_tab" class="tb_act">
                        <div class="page_container" id="dvdcover" style="width:420px;box-shadow: 0px 0px 3px 5px #B0BEC5;">
                        <div class="scroll" style=" background: url(./images/covers/gamecover4.jpg); -webkit-background-size: 100% 100%;">
                        </div>
                        </div>
                        <div class="page_container" id="GameDescDiv" style="width:760px;float:right;box-shadow: 0px 0px 3px 5px #B0BEC5;">
                            <div class="scroll" style="padding: 15px 20px 0 30px;">
                                <b>Product Description:</b>
                                <br><br>
                                    <p>
                                        The new features in FIFA 17 include new attacking techniques, physical player overhaul, active intelligence system and set piece rewrite. EA also announced at Gamescom 2016 that Squad Building Challenges and FUT Champions will be in FIFA Ultimate Team, but not in the Xbox 360 and PlayStation 3 editions of the game.[5]

Commentary is once again provided by Martin Tyler and Alan Smith with Alan McInally (in-game score updates), Geoff Shreeves (injury reports), and Mike West (classified results for major leagues). Commentary in other languages (such as Spanish and French) is also provided.[6]

EA Sports announced at E3 2016 that they will have all 20 Premier League managers' likenesses in the game.[7] New goal celebrations, such as Paul Pogba’s ‘Dab’ and Mesut Özil’s ‘M’ celebration, feature in the game.[8][9]
                                    </p>
                                <br>
                                <b>Price:</b> &nbsp&nbsp&nbsp<span>$300</span>
                                <br>
                                <button  class="btn">Add to Cart</button>
                                <button  class="btn">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
