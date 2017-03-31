<?php
session_start();
if(isset($_SESSION['login'])) {
	header('Location: insertdata.php');
}
?>

<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<div id = "containerOne">
	<h1 align = "center">Please Login:</h1>
	<p align = "center"><a href="index.html" type = "submit" align = "center" ><b>HOME</b></a></p>	
</div>

<div id = "containerLogin">
	<form action="" method="post" align = "center">
		<font color = "red"><b>User Name:</b></font>
			<input  type = "text" name="username" placeholder = "Username" required/><br />
		<font color = "red"><b>Password:</b></font>
			<input type="password" name="password" placeholder = "Password" required/><br />
			<input class = "button" type="submit" value="Login" name="submit"/>
	</form>
</div>

<?php




if (isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
 $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);//added this
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors());
	
$query = "SELECT * FROM Users WHERE Username='";
$query .=$username;
$query .="' and Password='";
$query .=$password;
$query .="'";
//changed to our table labels

//echo $query;

    $res = sqlsrv_query($conn, $query)
        or die("Failed to execute SQL (".$query.") : ".print_r(sqlsrv_errors()));
		 // echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;
	
    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        if ($firstrow == 1) {
          //  echo "<tr>";
            foreach ($row as $i => $value) {
             //  echo "<th>".$i."</th>\n";
            }
          //  echo "</tr>";
        }
        echo "<tr>\n";
        foreach ($row as $i => $value) {
          //  echo "<td>".$value."</td>\n";
        }
        //echo "</tr>";
        $firstrow = 0;
    }

   // echo "</table>\n";
		



if ($firstrow == 0){
	
	session_start();
	$_SESSION['login'] = "1";
	//header ("Location: insertdata.html")
	//get rid of usernam and password
	
		//$_SESSION['usernameS'] = $username;
		//$_SESSION['passwordS'] = $password;
	echo "<h3 align = 'center'><b> WELCOME ";
	echo $username;
	echo ": You have successfully logged in!</b></h3>";
	


	header( "refresh:2;url=insertdata.php" );

}else {
	
	echo "Login Failed";
	//$_SESSION['login'] = '';
	header( "refresh:2;url=login.php" );
	
	
}
}
?>

<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>

</body>
</html>