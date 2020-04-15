<?php
$type = htmlspecialchars($_GET["type"]) ;
if($type=="most")
{
$json = $_COOKIE['most_visited'];
$arr_most = json_decode($json,true); 
arsort($arr_most );
array_splice($arr_most , count($arr_most ) - 5, 5);
$arr_most = array_filter($arr_most);
$json = json_encode($arr_most);
}
else if($type=="recent")
{
         $json = $_COOKIE['recent_visited'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Game Store</title>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="./css/mystyle.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <script>
        $(document).ready(function () {



var gamelist = {
    "list": [
        {"gameid":"game1", "name":"Counter Strike" },
        {"gameid":"game2", "name":"PUB-G" },
        {"gameid":"game3", "name":"Need For Speed" },
        {"gameid":"game4", "name":"FIFA 2017" },
        {"gameid":"game5", "name":"Project-IGI" },
        {"gameid":"game6", "name":"Assassin's Creed" },
        {"gameid":"game7", "name":"GTA - 5" },
        {"gameid":"game8", "name":"TRON" },
        {"gameid":"game9", "name":"Age Of Empires III" },
        {"gameid":"game10", "name":"Crusader" }
    ]
};

$('.wrapper').hide();
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
$('.details_click').click(function() {
var gameid = $(this).attr('name');
		window.location = gameid+'.php?gameid='+gameid;
		})	
			if( '<?php echo $type; ?>' == 'most')
			{
                         $("#title").html("Top Most 5 visited products");
//                         debugger;
			var json_obj = jQuery.parseJSON ( '<?php echo $json; ?>');
var tablestring = '<table id="customers"><tr><th>Product</th><th>View Count</th</tr>';
var myData = [];
                         jQuery.each(json_obj , function(i, val) {
                           $("#" + i).show();
                               var list = gamelist["list"];
                            for (var j in list) {
                                 if(list[j].gameid== i)
                                        {
                                         tablestring = tablestring + '<tr><td>'+list[j].name+'</td><td>'+val+'</td></tr>';
                                         var obj = { 
                                         label: list[j].name,
                                         y: val
                                         };
                                        myData .push(obj);
                                        }
                                    }
                          });
tablestring = tablestring + '</table>';
 $("#gamelist").append(tablestring);

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Top Most 5 visited products:"
	},
	data: [{
		type: "pie",
		startAngle: 240,
                yValueFormatString: "(#\")\"",
		indexLabel: "{label} {y}",
		dataPoints: myData 
	}]
});
chart.render();

			}
			else
			{
                 var tablestring = '<table id="customers"><tr><th>Product</th><th>Rank</th</tr>';
                         $("#title").html("Last 5 recently viewed products");
			var json_obj = jQuery.parseJSON ( '<?php echo $json; ?>');
                         //debugger;
                         jQuery.each(json_obj , function(i, val) {
                           var list = gamelist["list"];
                            for (var j in list) {
                                 if(list[j].gameid== val)
                                        {
                                         tablestring = tablestring +'<tr><td>'+list[j].name+'</td><td>'+(i+1)+'</td></tr>';
                                        }
                                    }
                           $("#" + val).show();
                          });
tablestring = tablestring + '</table>';
 $("#gamelist").append(tablestring);
			}
			
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
                    <li class="li active"><a class="tab" id="title"></a></li>
                    <li id="cart"><a><i class="fa fa-cart-plus active" style="float:right;font-size:35px;"></i></a><a style="padding:19px 58px 11px 13px">MY CART</a></li>
                    <li class="li active" style="float:right"><a class="tab hvr-shutter-out-horizontal" href="index.php">Go Back</a></li>
                </ul>

                <div class="tab-content">
                    <div id="Main_tab" class="tb_act">
<div class="page_container" style="margin-left: 10px;margin-right:10px; width: 560px;box-shadow: 0px 0px 3px;"> 
<div id="gamelist" ></div>
<div id="chartContainer" style="height: 240px; width: 100%;"></div>
  </div>
                        <div class="page_container" style=" width: 610px;box-shadow: 0px 0px 3px;">              
                             <div id="pen_tab">
							 
					<div class="wrapper w3-animate-zoom" id="game1">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo1.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Counter Strike</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game1"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper  w3-animate-zoom" id="game2">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo2.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">PUB-G</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game2"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game3">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo3.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Need For Speed</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game3"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>

				   <div class="wrapper w3-animate-zoom" id="game4">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo4.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">FIFA 2017</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game4"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game5">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo5.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Project-IGI</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game5"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game6">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo6.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Assassin's Creed</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game6"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game7">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo7.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">GTA - 5</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game7"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game8">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo8.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">TRON</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game8"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game9">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo9.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Age Of Empires III</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game9"><span title="Click for more details">  
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                   </div>
				   
				   <div class="wrapper w3-animate-zoom" id="game10">
                      <div id="inner1">
                         <div id="mainbox">
                            <div id="imagebox"> <img src="./images/gamelogo10.png" style="width:83px; height:82px;"></div>
                         </div>
                      </div>
                    <div id="inner2">
                   <div id="textbox"><h5 color:"#212121";="" style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">Crusader</h5></div>
                    </div>
                  <div id="inner3">
                      <div id="buttonbox">

                          <a href="#"><span title="Click to Purchase the App">  
						  <i class="fa fa-plus-square" style="font-size:25px; color:green; float:right; margin-right:11px;"></i></span></a> 
                          <a class="details_click" href="#" name="game10"><span title="Click for more details"> 
						  <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:28px"></i> </span></a> 
						  <a href="#"><span title="Add to wishlist"> 
						  <i class="fa fa-heart" style="font-size:25px; color:red; float:left; margin-right:10px;"></i> </span></a> 
                      </div>
                    </div>
                             </div> 

                          </div>
                        </div>
                        </div>
                    </div>
                </div>

