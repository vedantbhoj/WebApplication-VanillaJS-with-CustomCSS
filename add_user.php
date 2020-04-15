<!DOCTYPE html>
<html lang="en">
<head>
<title>CMPE 272</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <link href="./css/mystyle.css" rel="stylesheet" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" />
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
</head>

   <style>
body {font-family: Arial, Helvetica, sans-serif; overflow:hidden;}
form {border: 3px solid #f1f1f1;}
label{margin-bottom: 0;}

input[type=text], input[type=password], input[type=email], input[type=tel] {
    width: 100%;
    padding: 0px 20px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #00BCD4;
    color: white;
    padding: 3px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #00BCD4;
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
    padding: 5px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
  
<body>
   
					<form method="post" class="form_container ">
					<label>First Name*</label>
						
                            <input type="text" placeholder="Enter FirstName"  required=""  name="FirstName" >
							<div class="clearfix"></div>
						

						<label>Last Name*</label>
						
                            <input type="text" name="LastName" placeholder="Enter LastName"  required="" >
							<div class="clearfix"></div>
						

						<label>Email*</label>
						    <input type="email" name="Email" placeholder="Enter Email ID"  required="" >
							<div class="clearfix"></div>
						

						<label>Home Address*</label>
						   <input type="text" name="Address" placeholder="Enter Address"  required="">
							<div class="clearfix"></div>
						

						<label>Home Phone*</label>
						   <input type="tel" pattern="^[0-9-+s()]*$" name="HomePhone" placeholder="Enter Home Phone"  required="">
							<div class="clearfix"></div>
						

						<label>Cell Phone*</label>
						    <input type="tel" pattern="^[0-9-+s()]*$" name="CellPhone" placeholder="Enter Cell Phone"  required="">
							<div class="clearfix"></div>
						
						<button type="submit" name="submit">Add User</button>
						
					</form>

	  <p>
	  </p>
	  <?php
$con =  mysqli_connect("bhojvedant2844138.ipagemysql.com", "vedant", "vedant","vedant");

if ($con ->connect_error) {
    die("Connection failed: " . $con ->connect_error);
} 

				extract($_POST);
				if(isset($_POST['submit']))
				{
				$query = "insert into MASTER_Users(FirstName, LastName, Email, Address, HomePhone, CellPhone) values ('$_POST[FirstName]','$_POST[LastName]', '$_POST[Email]','$_POST[Address]','$_POST[HomePhone]','$_POST[CellPhone]')";
		$query=mysqli_query($con,$query);
	
				if($query)
					{
 unset($_POST['submit']);
						echo "Records saved successfully";
					}	
					else
					{
 unset($_POST['submit']);
						echo "Failed to save the records successfully";
					}

				}

				?>

 

</body>
</html>
