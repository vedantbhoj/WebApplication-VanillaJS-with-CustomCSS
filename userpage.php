<!DOCTYPE html>
<html lang="en">
<head>
<title>User Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/mystyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="./js/jquery.dynatable.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
	  <form action="#" method="post">
Search With :-
<select name="select">                      
<option value="FirstName">First Name</option>
<option value="LastName">Last Name</option>
<option value="Address">Address</option>
<option value="HomePhone">Home Phone</option>
<option value="CellPhone">Cell Phone</option>
<option value="Email">Email ID</option>
</select>
<br/>
<input type="text" name="value">
<br/>
<input type="submit" name ="submit" value="Search">&nbsp
<input type="submit" name ="clear" value="Clear" id="clear">
</form>
<br/><br/><br/>

	<?php
$connect =  mysqli_connect("bhojvedant2844138.ipagemysql.com", "vedant", "vedant","vedant");

if ($connect ->connect_error) {
    die("Connection failed: " . $connect ->connect_error);
} 

if(isset($_POST['submit']))
{
$search = $_POST["select"];
$value = $_POST["value"];
$query = "select * from MASTER_Users where $search like '%$value%'";
$result = mysqli_query($connect , $query);

print("<table id="."customers"."><tr><td>Last Name</td><td>First Name</td><td>Email</td><td>Address</td><td>Home Phone</td><td>Cell Phone</td></tr>");

while ($row = mysqli_fetch_array($result)) 
{
echo "<tr><td>".$row['LastName']."</td>";
echo "<td>".$row['FirstName']."</td>";
echo "<td>".$row['Email']."</td>";
echo "<td>".$row['Address']."</td>";
echo "<td>".$row['HomePhone']."</td>";
echo "<td>".$row['CellPhone']."</td></tr>";
}
echo "</table>";		

unset($_POST['submit']);	
}	
?>
</form>
<script>
$(document).on("click", "#clear", function(){
$("#customers").hide();
$('input[name=value').val('');
});
</script>


</body>
</html>