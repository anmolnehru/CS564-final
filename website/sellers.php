<html>
	<title> Sellers </title>
<h3> Welcome Seller </h3>
<body>
<form action="list_page.php">
<fieldset>
Type Search Query:
<input type="text" name="search">
<select name="stype">
<option value="author">Author</option>
<option value="book">Book</option>
<option value="genre">Genre</option>
</select>
<input type="submit" value="Submit">
</fieldset>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "cs564";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "Sql Query for Most revenue generating Book";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Book: " . $row["name"]. " - Revenue: " . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql = "Sql Query for Most revenue generating Author";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Author: " . $row["name"]. " - Revenue: " . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql = "Sql Query for Most revenue generating Genre";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Genre: " . $row["genre"]. " - Revenue: " . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</body>
</html>
