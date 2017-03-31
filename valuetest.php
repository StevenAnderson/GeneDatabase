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
echo "<b> ";
	//echo $_SESSION['usernameS'];
	//echo "<b> Password= ";
	//echo $_SESSION['passwordS'];
	echo "<b> login value= '";
	echo $_SESSION['login'];
	echo "'";



?>



<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>

</body>
</html>