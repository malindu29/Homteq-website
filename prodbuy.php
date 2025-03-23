<?php
include("db.php"); // Include db.php file to connect to DB
$pagename = "A smart buy for a smart home"; // Create and populate a variable called $pagename

echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; // Call in stylesheet
echo "<title>" . $pagename . "</title>"; // Display name of the page as window title

echo "<body>";

include("headfile.html"); // Include header layout file

echo "<h4>" . $pagename . "</h4>"; // Display name of the page on the web page
//retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
//applied to the query string u_prod_id
//store the value in a local variable called $prodid
$prodid=$_GET['u_prod_id'];
//display the value of the product id, for debugging purposes
echo "<p>Selected product Id: ".$prodid;
//create a $SQL variable and populate it with a SQL statement that retrieves details for the selected product
$SQL="select prodId, prodName, prodPicNameLarge, prodDescripLong, prodPrice, prodQuantity 
from Product
where prodId=".$prodid;
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

$arrayp=mysqli_fetch_array($exeSQL);
echo "<table style='border: 0px'>";
echo "<tr>";
echo "<td style='border: 0px'>";
echo "<img src=images/".$arrayp['prodPicNameLarge']." height=350 width=350>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<div style='display: flex; flex-direction: column; align-items: flex-start;'>";
echo "<h5 style='margin: 0; padding: 0;'>".$arrayp['prodName']."</h5>"; //display product name as contained in the array
echo "<p class='updateInfo' style='margin: 5px 0; padding: 0; padding-top: 10;'>".$arrayp['prodDescripLong']."</p>";
echo "<p class='updateInfo' style='margin: 5px 0; padding: 0;'><b> &pound;".$arrayp['prodPrice']." </b></p>";
echo "<br><p>Number left in stock: ".$arrayp['prodQuantity'] ."</p>";
echo "<br><p>Number to be purchased: </p>";
//create form made of one text field and one button for user to enter quantity
//the value entered in the form will be posted to the basket.php to be processed
echo "<form action=basket.php method=post style='display: flex; align-items: center; padding-top:10;'>";
echo "<select name=p_quantity>";
for ($i=1; $i<=$arrayp['prodQuantity']; $i++)
{
echo "<option value=".$i.">".$i."</option>";
}
echo "</select>";
//echo "<input type=text name=p_quantity size=5 maxlength=3 style='margin-right: 10px;'>";
echo "<input type=submit name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
echo "<input type=hidden name=h_prodid value=".$prodid.">"; //pass the product id to the next page basket.php as a hidden value
echo "</form>";
echo "</div>";
echo "</td>";
echo "</tr>"; 
echo "</table>";
include("footfile.html"); // Include footer layout file

echo "</body>";
?>
