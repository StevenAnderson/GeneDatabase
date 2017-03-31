<?php
session_start();
if(isset($_SESSION['login'])) {
//echo "Your session is running " . $_SESSION['usernameS'];
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
	$datea.= "wow";
	$name= $_REQUEST['Name'];
	$genome= $_REQUEST['Genome'];
	$datea = $_REQUEST['Datea'];
	$accuracy= $_REQUEST['Accuracy'];
	$latin= $_REQUEST['Latin'];
	$chromosome	= $_REQUEST['Chromosome'];
	
	
	//echo $name;
	//echo $datea;
	
	
	
		  if ($genome == "") {////MAKE BUTTON OR CHANGE SQL TABLE TO Y/N
            $genome='NULL';
            }
	/*if ($date == "") {
            $date=''; ///
            }*/
				  if ($accuracy == "") {
            $accuracy='';
            }
	if ($latin == "") {
            $latin='NULL';
            }
				  if ($chromosome == "") {
            $chromosome='';
            }


    //Open a connection
    $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors());
	//$value = "searchGenome";
	
				$stSQL ="INSERT INTO SpeciesInfo ( SName, Genome, GenDate, GenAccuracy, LatinName, ChromosomeNumber)
					VALUES ('";//SID
					$stSQL.=$name;//SName
				$stSQL.="', '";
					$stSQL.=$genome;//Genome
				$stSQL.="', '";
					$stSQL.=$datea;//GenDate
				$stSQL.="', '";
					$stSQL.=$accuracy;//GenAccuracy
				$stSQL.="', '";
					$stSQL.=$latin;//LatinName
				$stSQL.="', '";
					$stSQL.=$chromosome;//Chromosome
					$stSQL.="')";
	
    //echo "executing '" . $stSQL . "'...<P>";
	

 	 
    $res = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors()));
	
    echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;
	
	//SName AS 'Name', Genome, GenDate AS 'Genome Date', GenAccuracy AS 'Genome Accuracy', LatinName AS 'Latin Name', ChromosomeNumber  As 'Chromosome Number'
	$recent = "Select 	SName AS 'Name', Genome, GenAccuracy AS 'Genome Accuracy', LatinName AS 'Latin Name', ChromosomeNumber  As 'Chromosome Number'

					From SpeciesInfo
					Where SName='";
					$recent.=$name;//SName
					$recent.="' AND Genome= '";
					$recent.=$genome;//Genome
				//$recent.="' AND GenDate= '";
					//$recent.=$date;//GenDate
				$recent.="' AND GenAccuracy= '";
					$recent.=$accuracy;//GenAccuracy
				$recent.="' AND LatinName= '";
					$recent.=$latin;//LatinName
				$recent.="' AND ChromosomeNumber= '";
					$recent.=$chromosome;//Chromosome
					$recent.="'";
	//echo $recent;
	 $res = sqlsrv_query($conn, $recent)
        or die("Failed to execute SQL (".$recent.") : ".print_r(sqlsrv_errors()));

		///FIX TABLE WHEN VALUES DONT HAVE ANYTHING IN THEM... MAYBE
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
	
?>
<p align = "center"><a href="insertdata.php" type = "submit" align = "center" ><b><font size="20">Add More</font></b></a></p>
<form id = "logout" action="logout.php" method="post" align = "center">
		<input type="submit" value="Logout" name="submit"/>
</form>

<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>
</body></html>
