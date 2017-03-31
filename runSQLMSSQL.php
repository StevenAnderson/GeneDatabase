<html><head>
		<title>DBMS Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		<script type="text/javascript" src="FooterInfo.js"></script>
</head>
<body>
<div id = "containerOne">
	<h1 align = "center">Search Results</h1>
<p align = "center"><a href="index.html" type = "submit" align = "center" ><b>HOME</b></a></p>		
</div>
<?php
	$SQL = $_REQUEST["SQL"];
	$value = $_POST['searchMenu'];
	$speciesMenu = $_POST['speciesmenu'];
    //Open a connection
    $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors());
	//$value = "searchGenome";
	switch($value){
		case NULL:
			echo "Please select an option";
			break;
		case "searchGenome":
			$stSQL = "SELECT SP.GeneName, G.Type
					From SpecificGene SP, SpeciesInfo SI, Genes G
					Where SP.SID=SI.SID AND SI.SName = '";
					$stSQL.=$speciesMenu;
					$stSQL.="' AND  SP.GID=G.GID";
			
			echo "<h3 align = 'center'><font color = 'white'>Searching All of the ".$speciesMenu. " Genes</font></h3>";
			break;
		case "species":
			$stSQL = "SELECT SI.SName as 'Species', SP.Chromosome, SP.GeneName
					From SpecificGene SP, SpeciesInfo SI, Genes G
					Where SP.SID=SI.SID AND G.HomoName='";
					$stSQL.=$SQL;
					$stSQL.="' AND  SP.GID=G.GID";
			echo "<h3 align = 'center'><font color = 'white'>Searching For ".$SQL. "</font></h3>";
			break;
		case "chromosome": //Need to fix dropdown
			$stSQL = "SELECT SI.SName as 'Species', G.HomoName as 'Gene Name'
					From SpecificGene SP, SpeciesInfo SI, Genes G
					Where SP.SID=SI.SID AND SP.Chromosome='";
					$stSQL.=$SQL;   
					$stSQL.="' AND SI.SName = '";
					$stSQL.=$speciesMenu;
					$stSQL.="' AND  SP.GID=G.GID";
			echo "<h3 align = 'center'><font color = 'white'>Searching All Genes On Chromosome ".$SQL. " In " .$speciesMenu. "</font></h3>";
			break;
		case "sequence":
			if($speciesMenu == "NULL"){
				$stSQL = "SELECT SI.SName as 'Species', G.HomoName as 'Gene Name', SP.Sequence
					From SpecificGene SP, SpeciesInfo SI, Genes G
					Where SP.SID=SI.SID   AND G.HomoName = '";
					$stSQL.=$SQL;
					$stSQL.="' AND  SP.GID=G.GID";
			echo "<h3 align = 'center'><font color = 'white'>Sequence For Gene ".$SQL. "</font></h3>";
		}
	//	echo $speciesMenu;
	/*
		else{
			$stSQL = "SELECT SI.SName as 'Species', SP.GeneName as 'Gene Name', SP.Sequence
					From SpecificGene SP, SpeciesInfo SI 
					Where SP.SID=(SELECT SI.SID FROM SpeciesInfo SI Where SI.SName='"
					$stSQL.=$speciesMenu;
					$stSQL.="') AND SI.GeneName = '";
					$stSQL.=$SQL;
					$stSQL.="'";
					//$stSQL.="' AND  SP.GID=G.GID";
			echo "<h3 align = 'center'><font color = 'white'>Sequence For Gene ".$SQL. "</font></h3>";
		}*/
			break;
		case "geneStructure":
			
			$stSQL = "Select G.HomoName as Gene, G.Structure
					From Genes G
					Where G.Structure='";
					$stSQL.=$SQL;
					$stSQL.="' AND G.Structure!= 'NULL'";
			echo "<h3 align = 'center'><font color = 'white'>All Genes With Gene Structure ".$SQL. "</font></h3>";
			break;
		case "homologues":
			$stSQL = "Select SI.SName as Species, SG.GeneName as 'Gene', G.HomoName as 'Homologue'
					From SpecificGene SG, SpeciesInfo SI, Genes G
					Where SG.SID=SI.SID AND G.GID=SG.GID AND G.HomoName='";
					$stSQL.=$SQL;
					$stSQL.= "' AND SG.GeneName!='";
					$stSQL.=$SQL;
					$stSQL.="'";
			
					
			echo "<h3 align = 'center'><font color = 'white'>All Homologues of ".$SQL. "</font></h3>";
			break;
		case "gene":
			$stSQL = "Select HomoName AS 'Name', Type, Structure
					From Genes
					Where HomoName ='";
					$stSQL.=$SQL;
					$stSQL.="'";
			echo "<h3 align = 'center'><font color = 'white'>Information On ".$SQL. "</font></h3>";
			break;
			
		default:
			echo "Error!";
			break;
	}

    $res = sqlsrv_query($conn, $stSQL)
        or die("Failed to execute SQL (".$stSQL.") : ".print_r(sqlsrv_errors()));
    echo "<table border='1' id = 'containerDisplayResults'>\n";
    $firstrow = 1;

    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        if ($firstrow == 1) {
            echo "<tr>";
            foreach ($row as $i => $value) {
                echo "<th>".$i."</th>\n";
            }
            echo "</tr>";
        }
        echo "<tr>\n";
        foreach ($row as $i => $value) {
            echo "<td>".$value."</td>\n";
        }
        echo "</tr>";
        $firstrow = 0;
    }

    echo "</table>\n";
	
	if ($firstrow!=0){
		echo "Please search again!";
		header( "refresh:2;url=runSQL.php" );
	}
	
	
	
    sqlsrv_close($conn)
	
?>


<p align = "center"><a href="runSQL.php" type = "submit" align = "center" ><b><font size="20">New Search</font></b></a></p>	

<div id = "containerFooter">
	<h2 align = "center">Zach Kinney and Steven Anderson</h2>
</div>


</body></html>
