<html>
	<title> Administrator </title>
<h3> Welcome Administrator</h3>
<body>
<form action="customer_submit.php">
<fieldset>
Customer Details:
ID:
<input type="text" name="id">
Name:
<input type="text" name="name">
Preferred Genre:
<input type="text" name="genre">
Money:
<input type="number" name="expenses">
<input type="submit" value="Submit">
</fieldset>
</form>

<form action="seller_submit.php">
<fieldset>
Seller Details:
ID:
<input type="text" name="id">
Name:
<input type="text" name="name">
Address:
<input type="text" name="address">
<input type="submit" value="Submit">
</fieldset>
</form>

<form action="book_submit.php">
<fieldset>
Book Details:
ISBN:
<input type="text" name="isbn">
Name:
<input type="text" name="name">
Genre:
<input type="text" name="genre">
Year:
<input type="text" name="year">
Pages:
<input type="number" name="pages">
<input type="submit" value="Submit">
</fieldset>
</form>

<form action="publisher_submit.php">
<fieldset>
Publisher Details:
ID:
<input type="text" name="id">
Name:
<input type="text" name="name">
Address:
<input type="text" name="address">
<input type="submit" value="Submit">
</fieldset>
</form>

<form action="sells_submit.php">
<fieldset>
Who sells what:
Seller:
<input type="text" name="seller_name">
ISBN:
<input type="text" name="isbn">
Price:
<input type="number" name="price">
<input type="submit" value="Submit">
</fieldset>
</form>


</body>
</html>
