<?php
$isbn = $_GET["isbn"];
$name = $_GET["seller_name"];
$price = $_GET["price"];




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

        $sql = "insert into sells select ".$isbn." as isbn, id, ".$price." from sellers where sellers.name=\"".$name."\"";

        $result = mysqli_query($conn, $sql);

	if ($result) {
                echo "Success";
	} else {
		echo "Error";
	}
mysqli_close($conn);

?>
