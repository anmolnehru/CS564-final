<?php
$isbn = htmlspecialchars($_GET["isbn"]);
$seller_name = $_GET["seller_name"];
$customer_name = $_GET["customer_name"];
echo 'ISBN: ' . $isbn;
echo "</br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs564";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


        $sql = "insert into transactions (select ".$isbn." as isbn, customers.id, sellers.id, price from customers, sellers, sells where customers.name=\"".$customer_name."\" and sellers.name=\"".$seller_name."\" and sells.seller_id=sellers.id and sells.book_id=".$isbn.");";
        $result = mysqli_query($conn, $sql);

        if ($result) {
        	echo $customer_name." bought isbn :" .$isbn. " from" .$seller_name ;
        } else {
                echo "error";
        }

mysqli_close($conn);

?>

