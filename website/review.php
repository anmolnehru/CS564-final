<?php
$isbn = htmlspecialchars($_GET["isbn"]);
$customer_name = $_GET["customer_name"];
$text = $_GET["entry"];
$rating = $_GET["rating"];
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


        $sql = "insert into reviews (select ".$isbn." as isbn, customers.id, \"".$text."\" as text," .$rating." as rating from customers where customers.name=\"".$customer_name."\");";
        $result = mysqli_query($conn, $sql);

        if ($result) {
        	echo $customer_name." reviewed isbn :" .$isbn ;
        } else {
                echo "error";
        }

mysqli_close($conn);

?>

