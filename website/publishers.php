<?php
//$name = $_GET["seller_name"];
?>

<html>
	<title> Publishers </title>
<h3> Welcome Publisher </h3>
<body>

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

echo "Best Author:";

$sql = "select authors.name, sum(price) as pr from authors, writes, transactions where authors.id = writes.auth_id and writes.book_id=transactions.book_id group by authors.name having sum(price) >= ALL (select sum(price) from authors, writes, transactions where authors.id = writes.auth_id and writes.book_id=transactions.book_id group by authors.name)";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo "<table><tr><th>Name</th><th>Revenue Generated</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["pr"]."</td></tr>";
    }
    echo "</table>";
}


echo "Most Revenue generating book:";
$sql = "select books.isbn, books.name,sum(price) as pr from books,transactions where books.isbn=transactions.book_id group by books.isbn order by sum(price) desc limit 10";
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
$sql = "select authors.name, sum(price) as pr from authors, transactions, writes where transactions.book_id=writes.book_id and writes.auth_id=authors.id group by authors.id order by sum(price) desc limit 10";

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
$sql = "select books.genre, sum(price) as pr from books, transactions where transactions.book_id=books.isbn group by books.genre order by sum(price) desc";
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

echo "Most Popular Books:";
$sql = "select isbn, name, count from books order by count desc limit 10";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>ISBN</th><th>Name</th><th>Copies Sold</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["isbn"]."</td><td>".$row["name"]."</td><td>".$row["count"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "<br>";

echo "Most Popular Authors:";
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

echo "Most Popular Genre:";
$sql="select books.genre, sum(count) as cnt from books group by books.genre order by sum(count) desc";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Genre</th><th>Copies Sold</th></tr>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["genre"]."</td><td>".$row["cnt"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


mysqli_close($conn);
?>
</body>
</html>
