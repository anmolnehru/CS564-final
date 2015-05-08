<?php
$name = $_GET["seller_name"];
?>

<html>
	<title> Sellers </title>
<h3> Welcome Seller : <?php echo $name;?></h3>
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
<input type="hidden" name="seller_name" value="<?php echo $name;?>"/>
<input type="submit" value="Submit">
</fieldset>
</form>

<?php
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


echo "Most Revenue generating book:";
$sql = "select books.isbn, books.name,sum(price) as pr from books,transactions,sellers where sellers.name=\"".$name."\" and sellers.id = transactions.seller_id and books.isbn=transactions.book_id group by books.isbn order by sum(price) desc limit 10";
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

echo "Most Revenue generating authors:";
$sql = "select authors.name, sum(price) as pr from authors, transactions, writes, sellers where sellers.name=\"".$name."\" and transactions.seller_id=sellers.id and transactions.book_id=writes.book_id and writes.auth_id=authors.id group by authors.id order by sum(price) desc limit 10";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
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

echo "Most Revenue generating genre:";
$sql = "select books.genre, sum(price) as pr from books, transactions, sellers where sellers.name=\"".$name."\" and transactions.seller_id=sellers.id and transactions.book_id=books.isbn group by books.genre order by sum(price) desc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
                echo "<table><tr><th>Genre</th><th>Revenue Generated</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["genre"]."</td><td>".$row["pr"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</body>
</html>
