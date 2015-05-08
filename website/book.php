<?php
$search_text = htmlspecialchars($_GET["search"]);
$search_type = htmlspecialchars($_GET["stype"]);
$price_min = $_GET["price_min"];
$price_max = $_GET["price_max"];
$rating_min = $_GET["rating_min"];
$rating_max = $_GET["rating_max"];
$name = $_GET["customer_name"];

echo 'Search Query: ' . $search_text;
echo "</br>";
echo 'Type is ' . $search_type . '!';
echo "</br>";
if(isset($_GET['price_box'])) {
    echo 'Min Price: ' .$price_min;
    echo ' Max Price: ' .$price_max;
    echo "</br>";
}

if(isset($_GET['rating_box'])) {
    echo 'Min Rating: ' .$rating_min;
    echo ' Max Rating: ' .$rating_max;
}

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
	echo "<br/>";
//	$sql = "Sql Query for Most revenue generating Author matching the search text";

        if(isset($GET['price_box'])) {

        $sql = "select distinct isbn,books.name from books, authors, writes, sells where books.isbn=writes.book_id and writes.auth_id = authors.id and sells.book_id=books.isbn and authors.name like \"%".$search_text."%\" and sells.price >=".$price_min." and sells.price <".$price_max;

        } else {
//		$sql = "select * from authors inner join (select distinct j1.isbn,j1.name,j1.rating,writes.auth_id from writes inner join (select distinct * from books inner join reviews on books.isbn=reviews.book_id)= j1 on writes.book_id=j1.isbn)=j2 on authors.id=j2.auth_id where authors.name like \"%".$search_text."%\" order by j2.rating desc";

        	$sql = "select isbn,books.name from books, authors, writes where books.isbn=writes.book_id and writes.auth_id = authors.id and authors.name like \"%".$search_text."%\"";

	}

        $result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
/*		while($row = mysqli_fetch_assoc($result)) {
			echo "Author: " . $row["name"]. " - Revenue: " . $row["price"]. "<br>";
		} */
                echo "<table><tr><th>ISBN</th><th>Name</th><th>Details</th></tr>";
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td><form action=\"book_details.php\"><input type=\"hidden\" name=\"isbn\" value=\"".$row["isbn"]."\"><input type=\"hidden\" name=\"customer_name\" value=\"".$name."\"><input type=\"submit\" value=\"Details\"></form></td></tr>";
                }
                echo "</table>";
	} else {
		echo "0 results";
	}
}

else if (strcmp($search_type, "book") == 0) {
	echo "<br/>";

        if(isset($_GET['price_box'])) {
        	$sql = "select distinct isbn, name, price from books, sells where books.name like \"%".$search_text."%\" and books.isbn = sells.book_id and sells.price >=".$price_min." and sells.price <".$price_max;
        } else {
//        	$sql = "(select books.isbn,books.name,j1.avgrate as avgrate from books left join (select reviews.book_id,avg(reviews.rating) AS avgrate from reviews group by reviews.book_id)=j1 on j1.book_id=books.isbn where books.name like \"%".$search_text."%\" order by j1.avgrate desc)";
	
       	$sql = "select isbn, name from books where books.name like \"%".$search_text."%\"";

	}

        $result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
	        echo "<table><tr><th>ISBN</th><th>Name</th><th>Details</th></tr>";
   	        // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td><form action=\"book_details.php\"><input type=\"hidden\" name=\"isbn\" value=\"".$row["isbn"]."\"><input type=\"hidden\" name=\"customer_name\" value=\"".$name."\"><input type=\"submit\" value=\"Details\"></form></td></tr>";
                }
                echo "</table>";
	} else {
		echo "0 results";
	}
}
else {
	echo "Displaying Revenue for Genre matching search query";
	echo "<br/>";
//	$sql = "select books.isbn,books.name,j1.avgrate from books inner join (select reviews.book_id,avg(reviews.rating) AS avgrate from reviews group by reviews.book_id)=j1 on j1.book_id=books.isbn where books.genre=\"".$search_text."\" order by j1.avgrate desc";
	


        if(isset($_GET['price_box'])) {
               $sql = "select distinct isbn, name, price from books, sells where books.genre like \"%".$search_text."%\" and books.isbn = sells.book_id and sells.price >=".$price_min." and sells.price <".$price_max;	      } else {
              $sql = "select books.isbn, books.name from books where books.genre=\"".$search_text."\"";
        }

        $result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
                echo "<table><tr><th>ISBN</th><th>Name</th><th>Details</th></tr>";
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td><form action=\"book_details.php\"><input type=\"hidden\" name=\"isbn\" value=\"".$row["isbn"]."\"><input type=\"hidden\" name=\"customer_name\" value=\"".$name."\"><input type=\"submit\" value=\"Details\"></form></td></tr>";
                }
                echo "</table>";
		}
	} else {
		echo "0 results";
	}
}
mysqli_close($conn);

?>
