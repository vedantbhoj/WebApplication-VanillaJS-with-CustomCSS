<?php 

$conn =  mysqli_connect("bhojvedant2844138.ipagemysql.com", "vedant", "vedant","vedant");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "SELECT * from users";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

    $users = array();

    while($row = mysqli_fetch_array($result)) {

        array_push($users,array(
            "UserID"=>$row['UserID'],
            "FirstName"=>$row['FirstName'],
            "LastName"=>$row['LastName'],
            "Email"=>$row['Email'],
            "City"=>$row['City'],
            "Phone"=>$row['Phone']
        ));
    }

    if($count > 0) {
        print(json_encode($users));
    } 
    else {
        print("No Users Found");
    }

mysqli_close($conn);

?>