<?php 
$conn =  mysqli_connect("bhojvedant2844138.ipagemysql.com", "vedant", "vedant","vedant");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$query = "SELECT * from products";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$products = array();
while($row = mysqli_fetch_array($result)) {
	array_push($products, array(
            "prodID"=>$row['prodID'],
            "prodCat"=>$row['prodCat'],
            "prodCatName"=> "Games",
            "prodName"=>$row['prodName'],
            "prodDesc"=>$row['prodDesc'],
            "prodPrice"=>$row['prodPrice'],
            "prodImg"=>$row['prodImg']
	));
}

if($count > 0) {
	print(json_encode($products));
} 
else {
	print("No products Found");
}
// Close MySQL connection
mysqli_close($conn);
?>