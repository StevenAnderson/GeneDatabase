<?php
session_start();
if(isset($_SESSION['login'])) {
// "Your session is running " . $_SESSION['usernameS'];
}
else {echo "You are not logged in!" ;
header('Location: login.php');
}
?>
<html><head>
		<title>DBMS Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id = "containerOne">
	<h1 align = "center">You Added:</h1>		
</div>
<?php
	//$species = $_POST['searchMenu'];
	$name= $_REQUEST['Name'];
	$type= $_REQUEST['Type'];
	$structure= $_REQUEST['Structure'];
	$speciesMenu= $_REQUEST['speciesmenu'];
	$chromo=$_REQUEST['Chromo'];
	$seq=$_REQUEST['Seq'];
	//$homo=$_REQUEST['Homo'];
	//$species= $_REQUEST['Species'];
	
	  if ($type == "") {
            $type='NULL';
            }
		
	if ($structure == "") {
            $structure='NULL';
            }
	if ($chromo == "") {
            $chromo='NULL';
            }
	if ($seq == "") {
            $seq='NULL';
            }

    //Open a connection
    $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors()); // insert gene entry
		
			$stSQL ="INSERT INTO Genes ( HomoName, Type, Structure) 
					VALUES ('";//gid
					//$stSQL.=", ";
					$stSQL.=$name;//homoname
					$stSQL.="', '";
					$stSQL.=$type;//type
					$stSQL.="', '";
					$stSQL.=$structure;//struct
					$stSQL.="')";
    $res1 = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors()));
		
		
		

			$stSQL = "Select GID 
					  From Genes 
					  Where HomoName ='";
			$stSQL.=$name;
			$stSQL.="'";
	
	$res2 = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors()));  // res 2 selecects GID
		
		
		
		
		
			$stSQL = "Select SID 
					  From SpeciesInfo 
					  Where SName ='";
			$stSQL.=$speciesMenu;
			$stSQL.="'";
			
	$res4 = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors())); // res 4 selecects SID
	
	
	
	
    //echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;

			$recent = "Select G.HomoName AS Name, G.Type, G.Structure
					From Genes G
					Where G.Structure='";
					$recent.=$structure;
					$recent.="' AND G.Type= '";
					$recent.=$type;
					$recent.="' AND G.HomoName= '";
					$recent.=$name;
					$recent.="'";
	//echo $stSQL;				
	//echo $recent;
    $res3 = sqlsrv_query($conn, $recent)
        or die("Failed to execute SQL (".$recent.") : ".print_r(sqlsrv_errors())); // RES3 selects gene insert results
	//echo "<div id = 'containerResults'>";



    while ($row = sqlsrv_fetch_array($res2, SQLSRV_FETCH_ASSOC)) {   // table getting gid
        if ($firstrow == 1) {
           // echo "<tr>";
            foreach ($row as $i => $value) {
               // echo "<th>" .$i."</th>\n";
            }
          //  echo "</tr>";
        }
        //echo "<tr>\n";
        foreach ($row as $i => $value) {
          //  echo "<td>" .$value."</td>\n";
			$gid = $value;/////////////////
        }
       // echo "</tr>";
        $firstrow = 0;
    }
    //echo "</table>\n";
	/////////////////////////////////////////////////////////////////////////////
	//echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;

    while ($row = sqlsrv_fetch_array($res4, SQLSRV_FETCH_ASSOC)) { // table gettting sig
        if ($firstrow == 1) {
           // echo "<tr>";
            foreach ($row as $i => $value) {
                //echo "<th>" .$i."</th>\n";
            }
            //echo "</tr>";
        }
       // echo "<tr>\n";
        foreach ($row as $i => $value) {
            //echo "<td>" .$value."</td>\n";
			$sid = $value;/////////////////
        }
       // echo "</tr>";
        $firstrow = 0;
    }
   // echo "</table>\n";
	
	$stSQL ="INSERT INTO SpecificGene ( SID, GID, GeneName, Chromosome, Sequence)
					VALUES ('";//gid
					//$stSQL.=", ";
					$stSQL.=$sid;
					$stSQL.="', '";
					$stSQL.=$gid;
					$stSQL.="', '";
					$stSQL.=$name;//homoname
					$stSQL.="', '";
					$stSQL.=$chromo;//type
					$stSQL.="', '";
					$stSQL.=$seq;//struct
					$stSQL.="')";
	
    $res5 = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors()));   /// Res 5 is inserting specific gene

		
			$recent = "Select SG.GeneName as 'Name', SG.Chromosome, G.Type, G.Structure, SG.Sequence
					From SpecificGene SG , Genes G
					Where SG.SID='";
					$recent.=$sid;
					$recent.="' AND SG.GID= '";
					$recent.=$gid;
					$recent.="' AND SG.GID=G.GID";
				
		 $res6 = sqlsrv_query($conn, $recent)
        or die("Failed to execute SQL (".$recent.") : ".print_r(sqlsrv_errors()));
			
    echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;
		
	while ($row = sqlsrv_fetch_array($res6, SQLSRV_FETCH_ASSOC)) { /// res6 results of specific gene insert
        if ($firstrow == 1) {
            echo "<tr>";
            foreach ($row as $i => $value) {
                echo "<th>" .$i."</th>\n";
            }
            echo "</tr>";
        }
        echo "<tr>\n";
        foreach ($row as $i => $value) {
            echo "<td>" .$value."</td>\n";
			/////////////////
        }
        echo "</tr>";
        $firstrow = 0;
    }
    echo "</table>\n";
	 /* echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;
		
	while ($row = sqlsrv_fetch_array($res3, SQLSRV_FETCH_ASSOC)) { /// res6 results of specific gene insert
        if ($firstrow == 1) {
            echo "<tr>";
            foreach ($row as $i => $value) {
                echo "<th>" .$i."</th>\n";
            }
            echo "</tr>";
        }
        echo "<tr>\n";
        foreach ($row as $i => $value) {
            echo "<td>" .$value."</td>\n";
			/////////////////
        }
        echo "</tr>";
        $firstrow = 0;
    }
    echo "</table>\n";
	*/
	
    sqlsrv_close($conn)
	/*
	//////////////////////////////////////////////////
	 //new connection for adding to specific Genes table
    $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors());
		
			$stSQL2 ="INSERT INTO SpecificGene ( GeneName, Chromosome, Sequence) 
					VALUES ('";//gid
					//$stSQL.=", ";
					$stSQL2.=$name;//homoname
					$stSQL2.="', '";
					$stSQL2.=$chromo;//type
					$stSQL2.="', '";
					$stSQL2.=$seq;//struct
					$stSQL2.="')";
			
    $res = sqlsrv_query($conn, $stSQL2)
        or die("Failed to execute SQL (".$stSQL2.") : ".print_r(sqlsrv_errors()));

    echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;

			$recent2 = "Select G.HomoName AS Name, G.Type, G.Structure
					From Genes G
					Where G.Structure='";
					$recent2.=$structure;
					$recent2.="' AND G.Type= '";
					$recent2.=$type;
					$recent2.="' AND G.HomoName= '";
					$recent2.=$name;
					$recent2.="'";
					
	echo $stSQL2;				
	echo $recent;
    $res = sqlsrv_query($conn, $recent2)
        or die("Failed to execute SQL (".$recent2.") : ".print_r(sqlsrv_errors()));
	//echo "<div id = 'containerResults'>";



    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        if ($firstrow == 1) {
            echo "<tr>";
            foreach ($row as $i => $value) {
                echo "<th>" .$i."</th>\n";
            }
            echo "</tr>";
        }
        echo "<tr>\n";
        foreach ($row as $i => $value) {
            echo "<td>" .$value."</td>\n";
        }
        echo "</tr>";
        $firstrow = 0;
    }
    echo "</table>\n";

    sqlsrv_close($conn)
*/
?>
<p align = "center"><a href="insertdata.php" type = "submit" align = "center" ><b><font size="20">Add More</font></b></a></p>	

<form id = "logout" action="logout.php" method="post" align = "center">
		<input type="submit" value="Logout" name="submit"/>
</form>


<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>
</body></html>
