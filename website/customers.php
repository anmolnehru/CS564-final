<?php
$name = $_GET["customer_name"];
?>
<html>
	<title> Customers </title>
<h3> Welcome Customer : <?php echo $name;?></h3>
<body>
<form action="book.php">
<fieldset>
Type Search Query:
<input type="text" name="search">
<select name="stype">
<option value="author">Author</option>
<option value="book">Book</option>
<option value="genre">Genre</option>
</select>
<br>
<input type="checkbox" name="price_box" value="price"> 
Price: <input type="number" name="price_min"> Min <input type="number" name="price_max"> Max <br>
<input type="checkbox" name="rating_box" value="rating">
Rating: <input type="number" name="rating_min"> Min <input type="number" name="rating_max"> Max <br>
<input type="hidden" name="customer_name" value="<?php echo $name;?>"/>
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


$sql = "select name, count from books order by count desc limit 10";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Name</th><th>Copies Sold</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["count"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "<br>";

$sql = "select authors.name, sum(count) as cnt from authors, writes, books where authors.id=writes.auth_id and books.isbn = writes.book_id group by authors.id order by sum(count) DESC limit 10";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Author</th><th>Copies Sold</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["cnt"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</body>
</html>
