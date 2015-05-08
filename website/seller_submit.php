<?php
$id = $_GET["id"];
$name = $_GET["name"];
$address = $_GET["address"];


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

        $sql = "insert into sellers values(".$id." , \"".$name."\", \"".$address."\")";

        $result = mysqli_query($conn, $sql);

	if ($result) {
                echo "Success";
	} else {
		echo "Error";
	}
mysqli_close($conn);

?>
