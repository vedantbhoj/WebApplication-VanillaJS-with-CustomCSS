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
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">

   <script>
    $(document).ready(function() {
//$('.maincontainer').css("width",window.screen.availWidth);
//$('.maincontainer').css("height",window.screen.availHeight);
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
//debugger;
if(sessionStorage.getItem("username") === null)
{
$("#add_usr_bar").show();
$("#login_bar").show();
$("#loggedin_user").hide();
$("#username").hide();
}
else
{
$("#add_usr_bar").hide();
$("#loggedin_user").show();
$("#username").show();
$("#username").html("Hi " + sessionStorage.getItem("username"));
$("#login_bar").hide();
}

$('.details_click').click(function() {
var gameid = $(this).attr('name');
		window.location = gameid+'.php?gameid='+gameid;
		})		

	$('.page_container').hide();
	$("#home_tab").show();
	    	 //document.getElementById("myVideo").load();
	    	 //document.getElementById("myVideo").muted=false;
		$('#home_bar').click(function() {
		$(".page_container").hide();
		$("#home_tab").show();
		$('.li').removeClass('active');
		$("#home").parent().addClass('active');
		   document.getElementById("myVideo").play(); 
		});
		
		$('#leader_bar').click(function() {
		alert('Stay Tuned!! Work in Progress')
		});

		$('#add_usr_bar').click(function() {
		alert('Stay Tuned!! Work in Progress')
		})		
		
        $('.tab').click(function() {
           //alert( $(this).attr('id'));
		   $(".page_container").hide();
		   var id = "#"+$(this).attr('id')+"_tab";
		   $(id).show();
		   $('.li').removeClass('active');
		   $(this).parent().addClass('active');
		   if($(this).attr('id')=="home")
		   {
		   document.getElementById("myVideo").play(); 
		   }
		   else
		   {
		   document.getElementById("myVideo").pause(); 
		   }

                   if($(this).attr('id')=="users")
		   {
                    debugger;
                      var tablestring = '<div><h3>Nest Away</h3></div><table id="customers"><tr><th>First Name</th><th>Last Name</th><th>Email</th> <th>City</th><th>Phone Number</th></tr>';

$.ajax({
    url : "curl_get_users.php",
    type : "get",
    async: false,
    success : function(data) {
 $.each(JSON.parse(data), function(i, obj){
                    tablestring = tablestring + '<tr><td>'+obj.FirstName+'</td><td>'+obj.LastName+'</td><td>'+obj.Email+'</td><td>'+obj.City+'</td><td>'+obj.Phone+'</td></tr>';
});
    $("#usertable").html(tablestring);   
    },
    error: function() {
       connectionError();
    }
 });

var tablestring = '<br><div><h3>Vedants Game Store</h3></div><table id="customers"><tr><th>First Name</th><th>Last Name</th><th>Email</th> <th>City</th><th>Phone Number</th></tr>';

$.ajax({
    url : "fetch_users.php",
    type : "get",
    async: false,
    success : function(data) {
 $.each(JSON.parse(data), function(i, obj){
                    tablestring = tablestring + '<tr><td>'+obj.FirstName+'</td><td>'+obj.LastName+'</td><td>'+obj.Email+'</td><td>'+obj.City+'</td><td>'+obj.Phone+'</td></tr>';
});
    $("#usertable").append(tablestring);   
    },
    error: function() {
       connectionError();
    }
 });
                } 

        });
    });
</script>

<style>
.li a
{ padding: 12px 40px; } 
</style>
</head>

<body>

 <div class="container">   
     <div class="navbar">
          <ul class="menu">
		  <li class="menu-item" style="margin-top:5px;"><a><i style="font-size: 50px;" class="fa fa-gamepad fa-lg"></i></a></li>
           <li class="menu-item"><span class="title">  Vedant's Game Store - The best games just for you !!!</span></li>
            <ul class="menu-right">
              <li class="menu-item" ><a data-toggle="tooltip" data-placement="bottom" title="Home" href="javascript:void(0)" id="home_bar" ><i class="fa fa-home fa-lg"></i></a></li>
                 <li class="menu-item"><a data-toggle="tooltip" data-placement="bottom" title="Leader Board"  href = "javascript:void(0)" id="leader_bar" ><i class="fa fa-trophy fa-lg"></i></a></li>
				 <li class="menu-item" id="add_usr_bar"><a data-toggle="tooltip" data-placement="bottom" title="Register"  href = "javascript:void(0)" ><i class="fa fa-user-plus fa-lg"></i></i></a></li>
				 <li class="menu-item" id="login_bar"><a data-toggle="tooltip" data-placement="bottom" title="Sign In"  href = "./login.html" id="signin_usr_bar" > <span>Login <i class="fa fa-sign-in-alt fa-lg"></i></span></a></li>
<li class="menu-item" id="username" style="margin-right: -35px;font-size: 15px; display:none; color: white;font-family: cursive;"></li>
 <li id="loggedin_user" class="menu-item" style="display:none;"><span class="welcome-user">
  <div class="dropdown">
  <button class="dropbtn">
  <span><img id="onMe" class="img avatar" src="./images/user.jpg" /></span>
  </button><div class="dropdown-content">
  <a href="#">Profile</a> 
  <a href="#">History</a> 
  <a href="#">Settings</a> 
    <a  href="#" onclick="logout()">Logout</a> 
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
      
       <li  class="active li" ><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)" id="home" >Home</a></li>
         <li  class="li"  ><a class="tab hvr-shutter-out-horizontal"  href="javascript:void(0)" id="about" >About</a></li>
       <li  class="li"><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)" id="product">Products</a></li>
	    <li  class="li"><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)" id="news">News</a></li>
	   <li  class="li"><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)"id="contact">Contacts</a></li>
	   <li  class="li"><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)" id="users">Combined Users</a></li>
	   <li  class="li"><a class="tab hvr-shutter-out-horizontal" href="javascript:void(0)" id="usection">User Section</a></li>
        <li id="cart"><a><i class="fa fa-cart-plus active" style="float:right;font-size:35px;"></i></a><a style="padding:19px 58px 11px 13px">MY CART</a></li> 

</ul>
  
        
        <div class="tab-content">      
            <div id="Main_tab" class="tb_act">    

<div class="page_container" id="usection_tab">
<iframe src="Database_Users.php" style="padding: 3px 3px 3px 3px;height: 469px;width: 880px;"></iframe>
</div>

<div class="page_container" id="users_tab">
<div class="scroll">
<div id="usertable">
</div>
</div>
</div>
			
			<div class="page_container" id="home_tab">
<div class="scroll">
<div id="pen_tab">
<video id="myVideo" style="    margin: 5px 0 0px 0px;    width: 885px;    object-fit: fill;    height: 459px;" autoplay muted>
  <source src="video.mp4" type="video/mp4">
</video>
		 </div> 

                          </div> 
                                     
                     </div>				
					
<div class="page_container" id="about_tab">
<div class="scroll">
<div id="pen_tab">
<div class="aboutus" style="margin:30px 30px"><h1 style="text-align: center;"><span style="color: #0078ff;">About Us</span></h1><blockquote><p style="text-align: center;">We put the EXTRA in extraordinary! Vedant's Game Store isn’t just your average&nbsp;hobby game store.&nbsp; We&nbsp;offer hard-to-find items, an outstanding selection of amazing products, an impressive gaming space, daily scheduled events, and a staff that genuinely wants to help!</p></blockquote><p>Our <strong>MISSION</strong> at Vedant's Game Store is to entertain our customers with our amazing variety of incredible products and to bring the exciting realms of imagination alive, all while providing exceptional customer service in a fun and family-friendly environment.</p><p>Our <strong>VISION</strong> is to continue to grow our franchise company by offering franchise opportunities in all 50 states for those who qualify to own and operate this fun, exciting and rewarding business.&nbsp; We firmly believe that our concept will be popular and successful anywhere in the US and in the world.</p><p>Our <strong>BRAND</strong> promise is to provide our guests with a fun and exciting atmosphere with friendly service by our talented and knowledgeable staff!</p><h3 style="text-align: center;"><em><span style="color: #0078ff;">Shop, Stay and Play!</span></em></h3></div>
                             </div> 

                          </div> 
                                     
                     </div>		



<div class="page_container" id="news_tab">
<div class="scroll">
<div id="pen_tab">
<div class="news" style="margin:30px 30px"><h1 style="text-align: center;"><span style="color: #0078ff;">Latest News</span></h1><blockquote><p style="text-align: center;">We put the EXTRA in extraordinary! Vedant's Game Store isn’t just your average&nbsp;hobby game store.&nbsp; We&nbsp;offer hard-to-find items, an outstanding selection of amazing products, an impressive gaming space, daily scheduled events, and a staff that genuinely wants to help!</p></blockquote><p>Our <strong>MISSION</strong> at Vedant's Game Store is to entertain our customers with our amazing variety of incredible products and to bring the exciting realms of imagination alive, all while providing exceptional customer service in a fun and family-friendly environment.</p><p>Our <strong>VISION</strong> is to continue to grow our franchise company by offering franchise opportunities in all 50 states for those who qualify to own and operate this fun, exciting and rewarding business.&nbsp; We firmly believe that our concept will be popular and successful anywhere in the US and in the world.</p><p>Our <strong>BRAND</strong> promise is to provide our guests with a fun and exciting atmosphere with friendly service by our talented and knowledgeable staff!</p><h3 style="text-align: center;"><em><span style="color: #0078ff;">Shop, Stay and Play!</span></em></h3></div>
                             </div> 

                          </div> 
                                     
                     </div>	


					 
					 
<div class="page_container" id="contact_tab">
<div class="scroll">
<div id="pen_tab">
<div class="contacts" style="margin:30px 30px">

<h3 style="text-align: center;"><span style="color: #0078ff;"> Store Locations </h3>
<p style="text-align:center">
<?php
//Read contact 1 from first file
$myfile1 = "./store_contact.txt";
$contact1= file_get_contents($myfile1);
echo nl2br($contact1);
//Read contact 2 from second file
$myfile2 = "./store_contact1.txt";
$contact2= file_get_contents($myfile2);
echo nl2br($contact2);
?>
</p>
<div class="contact_container">
<form action="/index.php">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">
	
    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:45px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>
</div>
                             </div> 

                          </div> 
                                     
                     </div>	
					 
                     <div class="page_container" id="product_tab">
                          <div class="scroll">
                             
                             <div id="pen_tab">
							 
					<div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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

				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
				   
				   <div class="wrapper w3-animate-zoom">
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
                            
                                                     <div class="filter_container">
                                                            <div class="filterheader">FILTER BY</div>
                                                              <p class="filterip">Game Type :
                                                                     <select id="PenSelectAppType" class="select">
                                                                      <option value="NULL">All</option>
                                                                      <option value="0" >Story Mode</option>
                                                                      <option value="1" >Level Mode</option>
																	  <option value="2" >18+</option>
																	  <option value="3" >FPS</option>
                                                                      </select>
                                                              </p>
                                                          <br>
	                                                          <p class="filterip">Game Price :
                                                                   <select class="select" id="BusinessUnitScroll1">
                                                                    <option value="NULL" >All</option>
																	 <option value="0">$5 - $10</option>
                                                                     <option value="1" >$10 - $25</option>
																	 <option value="2" >$25 - $50</option>
																	 <option value="3" >$50 - $100</option>
																	 <option value="4" >$100 + </option>
															</select>
                                                              </p >
                                                              <br>
<div style="text-align: center; display: grid;" >
<a href="cookieresult.php?type=recent" style="text-decoration: none;font-style: italic;color: blue;font-family: cursive;">Last 5 Visited Products</a>
</br>
<a href="cookieresult.php?type=most" style="text-decoration: none;font-style: italic;color: blue;font-family: cursive;">Most 5 Visited Products</a>
</div>
</br>
										  <div style="text-align: center;">Filter By Rating</div>
														<div class="rating">
															<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span> 
														 </div>                                                         
                                                            <button  class="btn" id="filter_button_inpendingtab">SUBMIT</button>
                                                            <button style="margin:-55px 0px 0 194px;"  id="reset1" class="btn">RESET</button>
                                                 </div> 
            </div>
        </div>
  </div>
  </div>      
 </div>
 <footer><marquee  behavior="alternate">All Rights Reserved.</marquee></footer>
</body>
<script>
function logout()
{
sessionStorage.removeItem('username');
window.location.href = "login.html";
}
</script>
</html>