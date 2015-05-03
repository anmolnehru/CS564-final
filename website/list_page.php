<?php
$search_text = htmlspecialchars($_GET["search"]);
$search_type = htmlspecialchars($_GET["stype"]);
echo 'Search Query: ' . $search_text;
echo "</br>";
echo 'Type is ' . $search_type . '!';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (strcmp($search_type, "author") == 0) {
	echo "Displaying Revenue for Author matching search query";
	echo "<br/>";
	$sql = "Sql Query for Most revenue generating Author matching the search text";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "Author: " . $row["name"]. " - Revenue: " . $row["price"]. "<br>";
		}
	} else {
		echo "0 results";
	}
}

else if (strcmp($search_type, "book")) {
	echo "Displaying Revenue for Book matching search query";
	echo "<br/>";
	$sql = "Sql Query for Most revenue generating Book matching the search text";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "Book: " . $row["name"]. " - Revenue: " . $row["price"]. "<br>";
		}
	} else {
		echo "0 results";
	}
}
else {
	echo "Displaying Revenue for Genre matching search query";
	echo "<br/>";
	$sql = "Sql Query for Most revenue generating Genre matching the search text";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "Genre: " . $row["genre"]. " - Revenue: " . $row["price"]. "<br>";
		}
	} else {
		echo "0 results";
	}
}
mysqli_close($conn);

?>
