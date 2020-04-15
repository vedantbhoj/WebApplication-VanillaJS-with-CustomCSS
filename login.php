<!DOCTYPE html>
<html>
<head>
<title>Authentication</title>
</head>   
<meta charset="utf-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <link href="./css/mystyle.css" rel="stylesheet" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

button {
    background-color: #00BCD4;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.main_container
{
    margin: auto;
    margin-top: 50px;
    width: 50%;
    border: 3px solid #00BCD4;
    padding: 10px;
}

.form_container {
    padding: 16px;
}

</style>
<body>
<div class="main_container">
<div class="content">
<h2 style="text-align: center;">The Game Store</h2>
<form>
<div class="form_container" style="text-align: center;">
<?php
extract($_POST);
$username = trim($username );
$password= trim($password);
$userlist = file ('username_password.txt');

$success = false;

foreach ($userlist as $user) {
    $user_details = explode(',', $user);
if (trim($user_details[0]) == $username && trim($user_details[1]) == $password) {
        $success = true;
        break;
    }
}

if ($success) {
   echo '<div style="text-align: center;">'."<h5>Hi $username, ".'you have been logged in successfully.</h5><br><i class="fa fa-check-circle" style="font-size: 60px;    color: #7eea15;    text-align: center;"></i></div><br><button id="continue" type="button">Continue to the Store</button><a href="./login.html"> <br><button type="button">Sign in with a different user</button> </a>';
echo '<table border="1"     style="margin: auto;"><tr><th>User Names</th></tr>';
foreach ($userlist as $user) {
$user_details = explode(',', $user);
echo "<tr><td>".$user_details[0]."</td></tr>";
}
echo "</table>";
} else {
   echo '<div style="text-align: center;"><h5>You have entered the wrong username or password.</h5><br><i class="fa fa-times-circle" style="font-size: 60px;    color: #d6073e;    text-align: center;"></i></div><a href="./login.html"><br> <button type="button">Go Back and Try Again</button> </a>';
}
?>

<script>
    if (typeof(Storage) !== "undefined") {
         sessionStorage.setItem('username', '<?php echo $username ?>');   
        } else {
            console.log("Sorry, your browser does not support Web Storage...");
        }
     $("#continue").click(function() {
      setTimeout(function(){
     window.location.href = "https://vedantbhoj.com/index.php";
     },100)
    }); // end of a.click function
</script>

</div>

</form>
</div>
<?php
if ($success) {
echo '<div style="text-align:center ; color:blue"><a  href="/username_password.txt" download>Download the User & Password list for reference</a></div>';

$to = "bhoj.vedant28@gmail.com, nikhillimaye10@gmail.com, ketan.rudrurkar@gmail.com, pratik.bhandarkar@sjsu.edu";
$subject = "HTML email";

$message = '
<html>
<head>
<title>HTML email</title>
</head>
<body>
<img src="http://vedantbhoj.com/images/1.jpg" alt="Smiley face" height="42" width="42">
<p>Hi my name is Richard Sinn!!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>Richard</td>
<td>Sinn</td>
</tr>
</table>
</body>
</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@cmpe272project.com>' . "\r\n";
$headers .= 'Cc: coolprofsinn@xyz.com' . "\r\n";

mail($to,$subject,$message,$headers);
}
?>
</div>
</body>
</html>