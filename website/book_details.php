<html>
<body>
<?php
$isbn = htmlspecialchars($_GET["isbn"]);
$name = $_GET["customer_name"];
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

	echo "Book Details";
	echo "<br/>";
	$sql = "select * from books where isbn=".$isbn;

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "Name: " . $row["name"]. "<br>";
                    //    echo "Author: " . $row["author"]. "<br>";
                        echo "Genre: " . $row["genre"]. "<br>";
                        echo "Copies Sold: " . $row["count"] . "<br>";
                        echo "Year: " .$row["year"] . "<br>";
                        echo "Pages: " .$row["pages"]. "<br>";
		}
	} else {
		echo "0 results";
	}

        $sql = "select authors.name from writes, authors where writes.book_id=".$isbn. " and writes.auth_id=authors.id";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                        echo "Author: " . $row["name"]. "<br>";
                }
        } else {
                echo "0 results";
        }

	echo "Displaying Sellers of this book";
	echo "<br/>";
	$sql = "select sellers.name, price from sells, sellers where sells.book_id=".$isbn. " and sells.seller_id = sellers.id order by price asc";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
    			echo "<table><tr><th>Name</th><th>Price</th><th>Buy</th></tr>";
    			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) {
        			echo "<tr><td>".$row["name"]."</td><td>".$row["price"]."</td><td><form action=\"buy.php\"><input type=\"hidden\" name=\"isbn\" value=\"".$isbn."\"><input type=\"hidden\" name=\"seller_name\" value=\"".$row["name"]."\"><input type=\"hidden\" name=\"customer_name\" value=\"".$name."\"><input type=\"submit\" value=\"Buy\"></form></td></tr>";
    			}
    			echo "</table>";
		}
	} else {
		echo "0 results";
	}


        echo "Reviews for this book";
        echo "<br>";
        $sql = "select customers.name, review, rating from reviews, customers where reviews.book_id=".$isbn." and customers.id=reviews.customer_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                        echo "<table><tr><th>Name</th><th>Review</th><th>Rating</th></tr>";
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>".$row["name"]."</td><td>".$row["review"]."</td><td>".$row["rating"]."</td></tr>";
                        }
                        echo "</table>";
                }
        } else {
                echo "0 results";
        }

mysqli_close($conn);

?>
<form action="review.php">
<fieldset>
Review: <br>
<textarea name="entry" rows="4" cols="50"></textarea>
<br>
Enter your rating:
<input type="number" name="rating">
<?php echo "<input type=\"hidden\" name=\"isbn\" value=\"".$isbn."\"><input type=\"hidden\" name=\"customer_name\" value=\"".$name."\">";?>
<input type="submit" value="Submit">
</fieldset>
</form>
</body>
</html>

