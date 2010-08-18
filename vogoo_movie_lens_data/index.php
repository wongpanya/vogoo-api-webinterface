<html>
<head>
<?php include("/home/bharath/public_html/vogoo_interface/password_protect.php"); ?>
<a href="http://dev1.aculus.com/~bharath/vogoo_interface/index.php?logout=1">Logout</a>
<?php
include('vogoo-2.2/vogoo/vogoo.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{?>
<h1 align="center"> VOGOO Recommendation System </h1>
<?php
}
?>
</head>

<body>
	<div id="main_menu" align="center">
                
		<br/><br/><br/>
		<a href="add_a_rating.php">Rate an Item</a><br/><br/>
		<a href="delete_a_rating.php">Delete a Rating</a><br/><br/>
	
		<h3>
			Type of Recommendation Systems : <br/><br/><br/>
			<a href="item_based.php">Item Based Recommendation</a><br/><br/>
			<a href="user_based.php">User Based Recommendation</a><br/>
		</h3>
	</div>
</body>
</html>
