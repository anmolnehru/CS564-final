<?php
$search_text = htmlspecialchars($_GET["search"]);
$search_type = htmlspecialchars($_GET["stype"]);
$seller_name = $_GET["seller_name"];
echo 'Search Query: ' . $search_text;
echo "</br>";
echo 'Type is ' . $search_type . '!';

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

if (strcmp($search_type, "author") == 0) {
	echo "Displaying Revenue for Author matching search query";
	echo "<br/>";
	$sql = "select authors.name, sum(price) as pr from authors, transactions, writes, sellers where sellers.name=\"".$seller_name."\" and transactions.seller_id=sellers.id and transactions.book_id=writes.book_id and writes.auth_id=authors.id and authors.name like \"%".$search_text."%\" group by authors.id order by sum(price) desc";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
	    // output data of each row
        echo "<table><tr><th>Author Name</th><th>Revenue Generated</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["pr"]."</td></tr>";
    }
    echo "</table>";
	} else {
		echo "0 results";
	}
}

else if (strcmp($search_type, "book")==0) {
	echo "Displaying Revenue for Book matching search query";
	echo "<br/>";
	$sql = "select isbn, books.name, sum(price) as pr from books, transactions, sellers where sellers.name=\"".$seller_name."\" and transactions.seller_id=sellers.id and transactions.book_id=books.isbn and books.name like \"%".$search_text."%\" group by books.isbn order by sum(price) desc";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
        echo "<table><tr><th>ISBN</th><th>Name</th><th>Revenue Generated</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td>".$row["pr"]."</td></tr>";
    }
    echo "</table>";
	} else {
		echo "0 results";
	}
}
else {
	echo "Displaying Revenue for Genre matching search query";
	echo "<br/>";
        $sql = "select isbn, books.name, sum(price) as pr from books, transactions, sellers where sellers.name=\"".$seller_name."\" and transactions.seller_id=sellers.id and transactions.book_id=books.isbn and books.genre like \"%".$search_text."%\" group by books.isbn order by sum(price) desc";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	        echo "<table><tr><th>ISBN</th><th>Name</th><th>Revenue Generated</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td>".$row["pr"]."</td></tr>";
    }
    echo "</table>";
        } else {
		echo "0 results";
	}
}
mysqli_close($conn);

?>
