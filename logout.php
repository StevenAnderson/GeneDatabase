<?php
session_start();
?>
<html><head>
		<title>DBMS Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<?php 
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

echo "<p align = 'center' type = 'submit' align = 'center' ><b><font size='20' color = red>Successful Logout</font></b></p>";
echo "<P>";
echo "<p align = 'center'><font size='15'>redirecting...</font></p>";
header( "refresh:3;url=index.html" );
?>



<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>

</body>
</html>