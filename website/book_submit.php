<?php
$isbn = $_GET["isbn"];
$name = $_GET["name"];
$genre = $_GET["genre"];
$year = $_GET["year"];
$pages = $_GET["pages"];

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

        $sql = "insert into books values(".$isbn." , \"".$name."\", \"".$genre."\", 0, ".$year.", ".$pages.")";

        $result = mysqli_query($conn, $sql);

	if ($result) {
                echo "Success";
	} else {
		echo "Error";
	}
mysqli_close($conn);

?>
