<?php
$isbn = $_GET["isbn"];
$year = $_GET["year"];

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


        $sql = "update books set year=".$year." where isbn=".$isbn."";
        $result = mysqli_query($conn, $sql);

	if ($result) {
                echo "Success";
	} else {
		echo "Error";
	}
mysqli_close($conn);

?>
