<?php
$gameid = htmlspecialchars($_GET["gameid"]) ;

//Top 5 recently visited
if(isset($_COOKIE['recent_visited'])) {
$arr_recent = json_decode($_COOKIE['recent_visited']);
if (!in_array($gameid, $arr_recent )) {
if(sizeof($arr_recent )==5)
{
array_shift($arr_recent);
array_push($arr_recent,$gameid);
}
else
{
array_push($arr_recent,$gameid);
}
setcookie("recent_visited",json_encode($arr_recent),time()+3600,"/");
}
}
else
{
$arr_recent= array();
array_push($arr_recent,$gameid);
setcookie("recent_visited",json_encode($arr_recent),time()+3600,"/");
}

//Top 5 visited
if(isset($_COOKIE['most_visited'])) {
$arr_most = json_decode($_COOKIE['most_visited'],true);
$arr_most[$gameid] = $arr_most[$gameid] + 1;
setcookie("most_visited",json_encode($arr_most ),time()+3600,"/");
}
else
{
$arr_most = array();
$product_count = 10;
for ($x = 1; $x <= $product_count ; $x++) {
$arr_most ['game'.$x]  = 0;
} 
$arr_most[$gameid] = $arr_most[$gameid] + 1;
setcookie("most_visited",json_encode($arr_most),time()+3600,"/");
}

?>