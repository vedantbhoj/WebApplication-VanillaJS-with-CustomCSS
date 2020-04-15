<!DOCTYPE html>
<html lang="en">
<head>
  <title>Database Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #00bcd4;
}
iframe{
    height: 410px;
    width: 850px;
}
</style>
</head>
<body>
<div style="padding:2px 2px 2px 2px; ">
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#add_user">Add New User</a></li>
    <li><a data-toggle="pill" href="#search_user">Search Users</a></li>
  </ul>
  
  <div class="tab-content">

    <div id="add_user" class="tab-pane fade in active">
<iframe src="add_user.php"></iframe>
    </div>

    <div id="search_user" class="tab-pane fade">
<iframe src="userpage.php"></iframe>
    </div>

    
  </div>
</div>

</body>
</html>
